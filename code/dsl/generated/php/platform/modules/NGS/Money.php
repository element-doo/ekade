<?php
namespace NGS;

require_once(__DIR__.'/Utils.php');
require_once(__DIR__.'/BigDecimal.php');

/**
 * Represents money values
 * Money is BigDecimal with scale value fixed to 2
 *
 * @property string $value String representation of money value
 * @property int $scale Extended from NGS\BigDecimal scale, fixed to 2
 */
class Money extends \NGS\BigDecimal
{
    /**
     * @var string String representation of decimal value.
     */
    protected $value;

    protected $scale = 2;

    /**
     *
     * @param \NGS\Money|int|string|float $value
     * @throws \InvalidArgumentException
     */
    public function __construct($value)
    {
        if ($value instanceof \NGS\BigDecimal) {
            $this->setValue($value->value);
        } else {
            $this->setValue($value);
        }
    }

    /**
     * Rounds up
     *
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
            $rounded = round((float)$value, $this->scale, PHP_ROUND_HALF_UP);
            $this->value = bcadd($rounded, 0, $this->scale);
        }
        elseif (is_int($value)) {
            $this->value = bcadd($value, 0, $this->scale);
        }
        elseif (is_float($value)) {
            $rounded = round($value, $this->scale, PHP_ROUND_HALF_UP);
            $this->value = bcadd($rounded, 0, $this->scale);
        }
        else {
            throw new \InvalidArgumentException('Invalid type for BigDecimal value, type was: "'.Utils::getType($value).'"');
        }
    }

    /**
     * Converts all elements in array to \NGS\Money instance
     *
     * @param array $items Source array, each element must be a valid argument for Money constructor
     * @param bool $allowNullValuesValues Allow elements with null value in array
     * @return array Resulting \NGS\Money array
     * @throws \InvalidArgumentException If any element is null or  invalid type for Money constructor
     */
    public static function toArray(array $items, $allowNullValuesValues=false)
    {
        $results = array();
        try {
            foreach ($items as $key => $val) {
                if ($allowNullValuesValues && $val===null) {
                    $results[] = null;
                } elseif ($val === null) {
                    throw new \InvalidArgumentException('Null value found in provided array');
                } elseif (!$val instanceof \NGS\Money) {
                    $results[] = new \NGS\Money($val);
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
}
