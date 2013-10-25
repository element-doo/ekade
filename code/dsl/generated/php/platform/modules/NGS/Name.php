<?php
namespace NGS;

/**
 * Helper functions for converting PHP class names to DSL names
 */
abstract class Name
{
    /**
     * Gets DSL name from class or object instance
     *
     * @param string|object $name Fully qualified class name or object instance
     * @return string DSL name
     * @throws \InvalidArgumentException If $name is not a string/object
     */
    public static function full($name)
    {
        if (is_object($name)) {
            $name = get_class($name);
        }
        elseif(!is_string($name)) {
            throw new \InvalidArgumentException('Invalid type for name, name was not string');
        }
        return str_replace('\\', '.', $name);
    }

    /**
     * Gets DSL module name from class or object instance
     *
     * @param string|object $name Fully qualified class name or object instance
     * @return string DSL name
     * @throws \InvalidArgumentException If $name is not a string/object
     */
    public static function base($name)
    {
        $names = explode('.', self::full($name));
        return array_pop($names);
    }

    /**
     * Converts DSL name to class name
     *
     * @param string|object $name Fully qualified class name or object instance
     * @return string DSL name
     * @throws \InvalidArgumentException If $name is not a string/object
     */
    public static function toClass($name)
    {
        if (is_object($name)) {
            return get_class($name);
        }
        elseif (is_string($name)) {
            return str_replace('.', '\\', $name);
        }
        else {
            throw new \InvalidArgumentException('Invalid type for object name');
        }
    }

    /**
     * Gets all but last name
     *
     * @param string|object $name Fully qualified class name or object instance
     * @return string DSL name
     * @throws \InvalidArgumentException If $name is not a string/object
     */
    public static function parent($name)
    {
        $names = explode('.', self::full($name));
        array_pop($names);
        return implode('.', $names);
    }
}
