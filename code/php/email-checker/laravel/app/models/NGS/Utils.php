<?php
namespace NGS;

/**
 * Some helper methods
 */
abstract class Utils
{
    private static $warningsAsErrors;

    /**
     * Returns type of variable, as in native gettype, or name of class if $var
     * is of 'object' or 'resource' type
     * @param mixed $var
     * @return string Type of variable
     */
    public static function getType($var)
    {
        // native gettype
        $type = \gettype($var);

        if($type === 'object')
            return get_class($var);
        if($type === 'resource')
            return get_resource_type($var);
        return $type;
    }

    /**
     * Controls whether certain warnings are thrown as exceptions (default)
     * If set to false, warnings are ignored
     * @param bool $wae True/false to turn on/off, null to get current value
     * @return bool If null is given
     */
    public static function WarningsAsErrors($wae = null)
    {
        if($wae === null)
            return self::$warningsAsErrors;
        self::$warningsAsErrors = (bool)$wae;
    }

    /**
     * Checks if json string is a json array
     * (only checks if  a string starts with a '[')
     * @param string $json A valid json string
     * @return bool
     */
    public static function isJsonArray($json)
    {
        return ord(ltrim($json)) === 91;
    }

    /**
     * Calls __toString on every member of given object array
     * @param array $list Array of objects
     * @return array Array of string values
     */
    public static function toStringArray(array $list)
    {
        $res = array();

        foreach ($list as $key => $val) {
            $res[$key] = $val !== null ? $val->__toString() : null;
        }

        return $res;
    }
}
