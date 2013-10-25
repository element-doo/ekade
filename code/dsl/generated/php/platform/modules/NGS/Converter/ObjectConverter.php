<?php
namespace NGS\Converter;

require_once(__DIR__.'/ConverterInterface.php');
require_once(__DIR__.'/../Name.php');
require_once(__DIR__.'/../Patterns/IDomainObject.php');

use NGS\Name;
use NGS\Patterns\IdomainObject;

/**
 * Generic object converter, for converting objects/object arrays of unknown type
 */
class ObjectConverter implements ConverterInterface
{
    const JSON_TYPE = 'Json';
    const ARRAY_TYPE = 'Array';

    /**
     * Serializes object or object array to JSON
     *
     * @param object|array Object or object array
     * @return string JSON encoded string
     */
    public static function toJson($object = null)
    {
        if(is_object($object)) {
            $converter = self::getConverter($object, 'Json');
            return $converter::toJson($object);
        }
        else if(is_array($object)) {
            $items = array();
            foreach($object as $key=>$obj) {
                if($obj === null) {
                    $items[$key] = null;
                }
                else if($obj instanceof IDomainObject) {
                    $converter = self::getConverter($obj, self::ARRAY_TYPE);
                    $items[$key] = $converter::toArray($obj);
                }
                else if(is_object($obj)){
                    $converter = self::getConverter($obj);
                    $items[$key] = $converter::toJson($obj);
                }
                else {
                    $items[$key] = $obj;
                }
            }
            return json_encode($items);
        }
    }

    /**
     * Converts JSON to object
     *
     * @param  string $json
     * @return mixed Object instance
     */
    public static function fromJson($json)
    {
        $converter = self::getConverter($object, 'Json');
        return $converter::fromJson($json);
    }

    /**
     * Determines appropriate converter class for given object
     *
     * @param object $object
     * @param string $type Converter type; one of 'Json' or 'Array'
     * @return \NGS\Converter\ConverterInterface
     */
    public static function getConverter($object, $type=self::JSON_TYPE)
    {
        if(!is_string($object)) {
            $object = get_class($object);
        }
        else {
            $object = Name::toClass($object);
        }
        $names = explode('\\', $object);
        $class = array_pop($names);
        $namespace = implode('\\', $names);

        // NGS primitive types follow convention NGS\Converter\[type]Converter
        if($names[0]==='NGS') {
            require_once(__DIR__.'/'.$class.'Converter.php');
            return 'NGS\\Converter\\'.$class.'Converter';
        }
        else {
            // @todo should be replaced with generated objects toJson method
            return $namespace.'\\'.$class.$type.'Converter';
        }
    }
}
