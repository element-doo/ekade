<?php
namespace PopisKada;

require_once __DIR__.'/KadaPoslanaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\KadaPoslana into a JSON string and backwards via an array converter.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class KadaPoslanaJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\PopisKada\KadaPoslana An object or an array of objects of type "PopisKada\KadaPoslana"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \PopisKada\KadaPoslanaArrayConverter::fromArrayList($obj, $allowNullValues)
            : \PopisKada\KadaPoslanaArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\PopisKada\KadaPoslana An object or an array of objects of type "PopisKada\KadaPoslana"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \PopisKada\KadaPoslanaArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}