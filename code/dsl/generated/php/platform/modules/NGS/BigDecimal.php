<?php
namespace NGS;

require_once(__DIR__.'/Utils.php');

use NGS\Utils;

/**
 * Used for arbitrary length decimal numbers
 * BigDecimal is a wrapper around primitive string type, and uses bcmath
 * functions for arithmetic operations
 *
 * @property string $value String representation of decimal value
 * @property int $scale Decimal scale (number of decimal places)
 */
class BigDecimal
{
    /** used for new instances, when scale isn't provided */
    const DEFAULT_SCALE = 20;

    /** @var string String representation of decimal value */
    protected $value;

    /** @var int scale */
    protected $scale;

    /**
     * Create a new instance with decimal value and scale
     *
     * @param int|string|float|\NGS\BigDecimal Decimal value or BigDecimal instance
     * @param int $scale Decimal scale (number of decimal places), uses scale from given BigDecimal instance, or uses default scale if null
     */
    public function __construct($value=0, $scale=null)
    {
        if ($value instanceof \NGS\BigDecimal) {
            $this->setScale($scale!==null ? $scale : $value->scale);
            $this->setValue($value->value);
        }
        else {
            $this->setScale($scale!==null ? $scale : self::DEFAULT_SCALE);
            $this->setValue($value);
        }
    }

    /**
     * Converts all elements in array to BigDecimal instance
     *
     * @param array $items Input array, each element must be a valid argument for BigDecimal constructor
     * @param bool  $allowNullValues Allow null values in input array
     * @return array Resulting BigDecimal array
     * @throws \InvalidArgumentException If any element is null or invalid type for BigInstance constructor
     */
    public static function toArray(array $items, $allowNullValues=false)
    {
        $results = array();
        try {
            foreach ($items as $key => $val) {
                if ($allowNullValues && $val===null) {
                    $results[] = null;
                } elseif ($val === null) {
                    throw new \InvalidArgumentException('Null value found in provided array');
                } elseif (!$val instanceof \NGS\BigDecimal) {
                    $results[] = new \NGS\BigDecimal($val);
                } else {
                    $results[] = $val;
                }
            }
        }
        catch(\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to BigDecimal!', 42, $e);
        }
        return $results;
    }

    /**
     * Converts all elements in array to \NGS\BigDecimal instance
     *
     * @param array $items Source array, each element must be a valid argument for BigDecimal constructor
     * @param int $scale Set non-BigDecimal values to this scale or use default if null
     * @param bool $allowNullValues Allow elements with null value in array
     * @return array BigDecimal Resulting BigDecimal array
     * @throws InvalidArgumentException If any element is null or invalid type for BigInstance constructor
     */
    public static function toArrayWithScale(array $items, $scale, $allowNullValues=false)
    {
        $results = array();
        try {
            foreach ($items as $key => $val) {
                if ($allowNullValues && $val===null) {
                    $results[] = null;
                } elseif ($val === null) {
                    throw new InvalidArgumentException('Null value found in provided array');
                } else {
                    $results[] = new \NGS\BigDecimal($val, $scale);
                }
            }
        }
        catch(\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to BigDecimal!', 42, $e);
        }
        return $results;
    }

    /**
     * Sets scale (number of decimal places)
     *
     * @param int $scale
     */
    protected function setScale($scale)
    {
        if (!is_int($scale)) {
            throw new \InvalidArgumentException('BigDecimal scale was not int, type was: "'.Utils::getType($scale).'"');
        }
        elseif ($scale<0) {
            throw new \InvalidArgumentException('BigDecimal scale cannot be negative value: "'.Utils::getType($scale).'"');
        }
        $this->scale = $scale;
    }

    /**
     * @param string|int|float $value
     */
    protected function setValue($value)
    {
        if ($value === null) {
            throw new \InvalidArgumentException('BigDecimal value cannot be null');
        }
        elseif (is_string($value)) {
            if (!filter_var($value, FILTER_VALIDATE_INT)
                && !preg_match('/^[-+]?\\d+([.]\\d+)?$/u', $value)) {
                throw new \InvalidArgumentException('Invalid characters in BigDecimal constructor string: '.$value);
            }
            $this->value = bcadd($value, 0, $this->scale);
        }
        elseif (is_int($value)) {
            $this->value = bcadd($value, 0, $this->scale);
        }
        elseif (is_float($value)) {
            $this->value = bcadd($value, 0, $this->scale);
        }
        else {
            throw new \InvalidArgumentException('Invalid type for BigDecimal value, type was: "'.Utils::getType($value).'"');
        }
    }

    /**
     * Returns string representation of decimal value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns decimal scale
     *
     * @return int
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Magic getter for accessing private value and scale properties
     */
    public function __get($name)
    {
        if($name==='value') {
            return $this->value;
        }
        else if($name==='scale') {
            return $this->scale;
        }
        else {
            throw new \InvalidArgumentException('Cannot get undefined property "'.$name.'"');
        }
    }

    /**
     * Returns string representation of decimal value
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * Returns string representation of decimal value with given scale
     *
     * @param int $scale Desired scale (number of decimal places)
     * @return string
     */
    public function toStringWith($scale)
    {
        return $this->format($scale);
    }

    /**
     * Returns string representation of decimal value with given scale
     *
     * @param int $scale Desired scale (number of decimal places)
     * @return string
     */
    public function format($scale)
    {
        return number_format($this->value, $scale);
    }

// ----------------------------------------------------------------------------

    protected function _add(BigDecimal $other)
    {
        return new BigDecimal(bcadd($this->value, $other->value, $this->scale), $this->scale);
    }

    /**
     * Adds another BigDecimal value to this instance
     *
     * @param $other BigDecimal Value to be added
     * @return BigDecimal Resulting BigDecimal instance
     */
    public function add($other)
    {
        return $this->_add(new BigDecimal($other, $this->scale));
    }

    protected function _sub(BigDecimal $other)
    {
        return new BigDecimal(bcsub($this->value, $other->value, $this->scale), $this->scale);
    }

    /**
     * Subtract another BigDecimal value from this instance
     *
     * @param $other BigDecimal Value to be subtracted
     * @return BigDecimal Resulting BigDecimal instance
     */
    public function sub($other)
    {
        return $this->_sub(new BigDecimal($other, $this->scale));
    }

// ----------------------------------------------------------------------------

    protected function _comp(BigDecimal $other)
    {
        return bccomp($this->value, $other->value, $this->scale);
    }

    /**
     * Compares with another BigDecimal
     *
     * @param $other BigDecimal Value to compare with
     * @return int Returns 0 if the two values are equal, 1 if other value is
     * larger, -1 otherwise.
     */
    public function comp($other)
    {
        return $this->_comp(new BigDecimal($other, $this->scale));
    }

    protected function _gt(BigDecimal $other)
    {
        return $this->comp($other) > 0;
    }

    /**
     * Check if this value is greater than another BigDecimal
     *
     * @param $other BigDecimal Value to compare with
     * @return bool Returns true if greater than other, false otherwise
     */
    public function gt($other)
    {
        return $this->_gt(new BigDecimal($other, $this->scale));
    }

    protected function _gte(BigDecimal $other) {
        return $this->comp($other) >= 0;
    }

    /**
     * Check if this value is greater or equal than another BigDecimal
     *
     * @param $other BigDecimal Value to compare with
     * @return bool Returns true if greater or equal than other, false otherwise
     */
    public function gte($other)
    {
        return $this->_gte(new BigDecimal($other, $this->scale));
    }

    protected function _lt(BigDecimal $other)
    {
        return $this->comp($other) < 0;
    }

    /**
     * Check if this instance is less than another BigDecimal
     *
     * @param $other BigDecimal Value to compare with
     * @return bool Returns true if less than other, false otherwise
     */
    public function lt($other)
    {
        return $this->_lt(new BigDecimal($other, $this->scale));
    }

    protected function _lte(BigDecimal $other)
    {
        return $this->comp($other) <= 0;
    }

    /**
     * Check if this instance is less or equal than another BigDecimal
     *
     * @param $other BigDecimal Value to compare with
     * @return bool Returns true if less or equal than other, false otherwise
     */
    public function lte($other)
    {
        return $this->_lte(new BigDecimal($other, $this->scale));
    }

// ----------------------------------------------------------------------------

    protected function _mul(BigDecimal $other)
    {
        return new BigDecimal(bcmul($this->value, $other->value, $this->scale), $this->scale);
    }

    /**
     * Multiply with another BigDecimal
     *
     * @param $other BigDecimal Value to multiply with
     * @return BigDecimal Resulting BigDecimal instance
     */
    public function mul($other)
    {
        return $this->_mul(new BigDecimal($other, $this->scale));
    }

    protected function _div(BigDecimal $other)
    {
        return new BigDecimal(bcdiv($this->value, $other->value, $this->scale), $this->scale);
    }

    /**
     * Divide with another BigDecimal
     *
     * @param $other BigDecimal Value to divide with
     * @return BigDecimal Resulting BigDecimal instance
     */
    public function div($other)
    {
        return $this->_div(new BigDecimal($other, $this->scale));
    }

    protected function _mod(BigDecimal $other)
    {
        return new BigDecimal(bcmod($this->value, $other->value, $this->scale), $this->scale);
    }

    /**
     * Get modulus with another BigDecimal
     *
     * @param $other BigDecimal Value to multiply with
     * @return BigDecimal Resulting BigDecimal instance
     */
    public function mod($other)
    {
        return $this->_mod(new BigDecimal($other, $this->scale));
    }

// ----------------------------------------------------------------------------

    protected function _pow(BigDecimal $other)
    {
        return new BigDecimal(bcpow($this->value, $other->value, $this->scale));
    }

    /**
     * Raise this value to another BigDecimal value
     *
     * @param $other BigDecimal Value to multiply with
     * @return BigDecimal Resulting BigDecimal instance
     */
    public function pow($other)
    {
        return $this->_pow(self::from($other));
    }

    /**
     * Square root
     *
     * @return BigDecimal Resulting BigDecimal instance
     */
    public function sqrt()
    {
        return new BigDecimal(bcsqrt($this->value, $this->scale), $this->scale);
    }
}
