<?php
namespace PopisKada;

require_once __DIR__.'/KadaDodanaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\KadaDodana into a JSON string and backwards via an array converter.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class KadaDodanaJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\PopisKada\KadaDodana An object or an array of objects of type "PopisKada\KadaDodana"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \PopisKada\KadaDodanaArrayConverter::fromArrayList($obj, $allowNullValues)
            : \PopisKada\KadaDodanaArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\PopisKada\KadaDodana An object or an array of objects of type "PopisKada\KadaDodana"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \PopisKada\KadaDodanaArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}