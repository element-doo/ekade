<?php
namespace NGS\Converter;

require_once(__DIR__.'/../Utils.php');

use InvalidArgumentException;
use NGS\Utils;

/**
 * Converts values to primitive php types (string, integer, float, boolean)
 */
abstract class PrimitiveConverter
{
    /**
     * Converts value to integer type
     * @param float|integer|string $value
     * @return integer
     * @throws InvalidArgumentException If $value cannot be converted to integer
     */
    public static function toInteger($value)
    {
        $result = filter_var($value, FILTER_VALIDATE_INT);
        if ($result === false) {
            throw new InvalidArgumentException('Could not convert value '.$value.' of type "'.Utils::getType($value).'" to integer!');
        }
        return $result;
    }

    /**
     * Converts all values in array to integer types. Resulting array will be
     * reindexed with numeric indices.
     *
     * @param array $items
     * @return array
     * @throws InvalidArgumentException If any element in array containts null
     * value or cannot be converted to integer
     */
    public static function toIntegerArray(array $items, $allowNullValues=false)
    {
        $results = array();
        try {
            foreach ($items as $key => $val) {
                if ($allowNullValues && $val===null) {
                    $results[] = null;
                } elseif ($val === null) {
                    throw new InvalidArgumentException('Null value found in provided array');
                } else {
                    $results[] = self::toInteger($val);
                }
            }
        }
        catch(\Exception $e) {
            throw new InvalidArgumentException('Element at index '.$key.' could not be converted to integer!', 42, $e);
        }
        return $results;
    }

    /**
     * Converts value to string
     *
     * @param mixed $value Value
     * @return string Resulting string
     * @throws InvalidArgumentException If value cannot be converted to string,
     * or its length exceeds given $length
     */
    public static function toString($value)
    {
        if (is_string($value)) {
            return $value;
        }
        if (is_int($value) || is_float($value)) {
            return (string) $value;
        }
        throw new InvalidArgumentException('Could not convert value '.$value.' of type "'.Utils::getType($value).'" to string!');
    }

    /**
     * Converts value to string and checks it doesn't exceed maximum length
     *
     * @param mixed $value Value
     * @param integer $length Maximum allowed string length
     * @return string Resulting string
     * @throws InvalidArgumentException If value cannot be converted to string,
     * or its length exceeds given $length
     */
    public static function toFixedString($value, $length)
    {
        $string = self::toString($value);
        if (!is_int($length)) {
            throw new InvalidArgumentException('Fixed string length must be an integer, invalid type was: '.Utils::getType($length));
        }
        if (mb_strlen($string)>$length) {
            throw new InvalidArgumentException('String exceeds fixed length ('.$length.')');
        }
            //return mb_substr($value, $length);
        return $value;
    }

    /**
     * Converts all values in array to string types. Resulting array will be
     * reindexed with numeric indices.
     *
     * @param array $items Array of values convertible to strings
     * @return array Array of strings with reindexed keys
     * @throws InvalidArgumentException If any array element cannot be converted
     * to string
     */
    public static function toStringArray(array $items, $allowNullValues=false)
    {
        $results = array();
        try {
            foreach ($items as $key => $val) {
                if ($allowNullValues && $val===null) {
                    $results[] = null;
                } elseif ($val === null) {
                    throw new InvalidArgumentException('Null value found in provided array');
                } else {
                    $results[] = self::toString($val);
                }
            }
        }
        catch(\Exception $e) {
            throw new InvalidArgumentException('Element at index '.$key.' could not be converted to string!', 42, $e);
        }
        return $results;
    }

    /**
     * Converts all values in array to string types and checks that each string
     * length doesn't exceed maximum length.
     * Resulting array will be reindexed with numeric indices.
     *
     * @param array $items Array of values convertible to strings
     * @param type $length Maximum allowed string length
     * @return array Array of strings with reindexed keys
     * @throws InvalidArgumentException If any array element cannot be converted
     * to string, or its value exceeds given $length
     */
    public static function toFixedStringArray(array $items, $length, $allowNullValues=false)
    {
        $strings = self::toStringArray($items, $allowNullValues);
        if (!is_int($length)) {
            throw new InvalidArgumentException('Fixed string length must be an integer, invalid type was: '.Utils::getType($length));
        }
        foreach ($strings as $index=>$string) {
            if ($length!==null && mb_strlen($string)>$length) {
                throw new InvalidArgumentException('String at index '.$index.' exceeds fixed length ('.$length.')');
            }
        }
        return $strings;
    }

    /**
     * Converts value to boolean; valid string values are: 'true','1',
     * 'on','false','0','off' (all case-insensitive); valid integer values are
     * 0 and 1
     *
     * @param bool|string|integer Source value
     * @return boolean Converted value
     * @throws InvalidArgumentException If value cannot be converted to boolean
     */
    public static function toBoolean($value)
    {
        if(is_bool($value))
            return $value;
        if(is_string($value)) {
            $lcValue = strtolower($value);
            if($lcValue === 'true' || $lcValue === 'on' || $lcValue === '1')
                return true;
            if($lcValue === 'false' || $lcValue === 'off' || $lcValue === '0' || $lcValue === '')
                return false;
            throw new InvalidArgumentException('Could not convert value "'.$value.'" of type "string" to boolean!');
        }
        if(is_int($value)) {
            if($value === 1)
                return true;
            if($value === 0)
                return false;
            throw new InvalidArgumentException('Could not convert value '.$value.' of type "integer" to boolean!');
        }
        throw new InvalidArgumentException('Could not convert value '.$value.' of type "'.Utils::getType($value).'" to boolean!');
    }

    /**
    * Converts all values in array to bool types. Resulting array will be
    * reindexed with numeric indices.
    * For list of valid values, see: {@see PrimitiveConverter::toBoolean()}
    *
    * @param array $items Array of values convertible to booleans.
    * @return array Array of booleans with reindexed keys
    * @throws InvalidArgumentException If any array element cannot be converted
    * to string, or its value exceeds given $length
    */
    public static function toBooleanArray(array $items, $allowNullValues=false)
    {
        $results = array();
        try {
            foreach ($items as $key => $val) {
                if ($allowNullValues && $val===null) {
                    $results[] = null;
                } elseif ($val === null) {
                    throw new InvalidArgumentException('Null value found in provided array');
                } else {
                    $results[] = self::toBoolean($val);
                }
            }
        }
        catch(\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to boolean!', 42, $e);
        }
        return $results;
    }

    /**
     * Converts value to float.
     *
     * @param bool|string|integer Source value
     * @return float Converted value
     * @throws InvalidArgumentException If value cannot be converted to float
     */
    public static function toFloat($value)
    {
        $result = filter_var($value, FILTER_VALIDATE_FLOAT);
        if ($result === false) {
            throw new InvalidArgumentException('Could not convert value '.$value.' of type "'.Utils::getType($value).'" to float!');
        }
        return $result;
    }

    /**
     * Converts all values in array to float types. Resulting array will be
     * reindexed with numeric indices.
     *
     * @param array $items
     * @return array
     * @throws InvalidArgumentException If any element in array containts null
     * value or cannot be converted to float
     */
    public static function toFloatArray(array $items, $allowNullValues=false)
    {
        $results = array();
        try {
            foreach ($items as $key => $val) {
                if ($allowNullValues && $val===null) {
                    $results[] = null;
                } elseif ($val === null) {
                    throw new InvalidArgumentException('Null value found in provided array');
                } else {
                    $results[] = self::toFloat($val);
                }
            }
        }
        catch(\Exception $e) {
            throw new InvalidArgumentException('Element at index '.$key.' could not be converted to float!', 42, $e);
        }
        return $results;
    }

    /**
     * Converts all values in array to string type. As toStringArray, but
     * preserves original array keys.
     *
     * @param array $items Array of values convertible to strings
     * @return array Array of strings with preserved original keys
     * @throws InvalidArgumentException If any array element cannot be converted
     * to string
     */
    public static function toMap(array $items)
    {
        try {
            foreach ($items as $key => &$val) {
                if($val === null) {
                    throw new InvalidArgumentException('Null value found in provided array');
                }

                $val = self::toString($val);
            }
        }
        catch(\Exception $e) {
            throw new InvalidArgumentException('Element '.$key.' could not be converted to string!', 42, $e);
        }
        return $items;
    }

    /**
     * Converts all values in array to string map (string array), runs toMap()
     * on each element.
     *
     * @param array $items Array of string maps
     * @return array Array of string arrays with preserved original keys
     * @throws InvalidArgumentException If any array element cannot be converted
     * to string map
     */
    public static function toMapArray(array $items)
    {
        try {
            foreach ($items as $key => &$val) {
                if($val === null) {
                    throw new InvalidArgumentException('Null value found in provided array');
                }
                $val = self::toMap($val);
            }
        }
        catch(\Exception $e) {
            throw new InvalidArgumentException('Element at index '.$key.' could not be converted to array[string, string]!', 42, $e);
        }
        return $items;
    }
}
