<?php
namespace NGS;

require_once(__DIR__.'/Utils.php');

use NGS\Utils;

class BigInt
{
    private $value;

    public static function from($value)
    {
        if (null === $value) {
            throw new \InvalidArgumentException('BigInt value cannot be null');
        }
        elseif (is_string($value)) {
            if (!preg_match('/^[-+]?\\d+$/u', $value)) {
                throw new \InvalidArgumentException('Invalid characters in BigInt constructor string: '.$value);
            }

            return new BigInt($value);
        }
        elseif (is_object($value) && ('NGS\BigInt' === get_class($value))) {
            return $value;
        }
        elseif (is_int($value))
        {
            return new BigInt((string) $value);
        }

        throw new \InvalidArgumentException('BigInt could not be constructed from type "'.Utils::getType($value).'"');
    }

    private function __construct($value)
    {
        $this->value = $value;
    }

    public static function toArray(array $items)
    {
        try {
            foreach ($items as $key => &$val) {
                if($val === null) {
                    throw new \InvalidArgumentException('Null value found in provided array');
                }
                if(!$val instanceof \NGS\BigInt) {
                    $val = self::from($val);
                }
            }
        }
        catch(\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to BigInt!', 42, $e);
        }
        return $items;
    }
// ----------------------------------------------------------------------------

    private function _add(BigInt $other)
    {
        return new BigInt(bcadd($this->value, $other->value, 0));
    }

    public function add($other)
    {
        return $this->_add(self::from($other));
    }

    private function _sub(BigInt $other)
    {
        return new BigInt(bcsub($this->value, $other->value, 0));
    }

    public function sub($other)
    {
        return $this->_sub(self::from($other));
    }

// ----------------------------------------------------------------------------

    private function _comp(BigInt $other)
    {
        return bccomp($this->value, $other->value, 0);
    }

    public function comp($other)
    {
        return $this->_comp(self::from($other));
    }

    private function _gt(BigInt $other)
    {
        return $this->comp($other) > 0;
    }

    public function gt($other)
    {
        return $this->_gt(self::from($other));
    }

    private function _gte(BigInt $other)
    {
        return $this->comp($other) >= 0;
    }

    public function gte($other)
    {
        return $this->_gte(self::from($other));
    }

    private function _lt(BigInt $other)
    {
        return $this->comp($other) < 0;
    }

    public function lt($other)
    {
        return $this->_lt(self::from($other));
    }

    private function _lte(BigInt $other)
    {
        return $this->comp($other) <= 0;
    }

    public function lte($other)
    {
        return $this->_lte(self::from($other));
    }

// ----------------------------------------------------------------------------

    private function _mul(BigInt $other)
    {
        return new BigInt(bcmul($this->value, $other->value, 0));
    }

    public function mul($other)
    {
        return $this->_mul(self::from($other));
    }

    private function _div(BigInt $other)
    {
        return new BigInt(bcdiv($this->value, $other->value, 0));
    }

    public function div($other)
    {
        return $this->_div(self::from($other));
    }

    private function _mod(BigInt $other) {
        return new BigInt(bcmod($this->value, $other->value, 0));
    }

    public function mod($other)
    {
        return $this->_mod(self::from($other));
    }

// ----------------------------------------------------------------------------

    private function _pow(BigInt $other)
    {
        return new BigInt(bcpow($this->value, $other->value, 0));
    }

    public function pow($other)
    {
        return $this->_pow(self::from($other));
    }

    private function _powmod(BigInt $other, BigInt $modulus)
    {
        return new BigInt(bcpowmod($this->value, $other->value, $modulus->value, 0));
    }

    public function powmod($other, $modulus)
    {
        return $this->_powmod(self::from($other), self::from($modulus));
    }

    public function sqrt()
    {
        return new BigInt(bcsqrt($this->value, 0));
    }

// ----------------------------------------------------------------------------

    public function __toString()
    {
        return $this->value;
    }
}
