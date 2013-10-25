<?php
namespace PopisKada;

require_once __DIR__.'/KadaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\Kada into a JSON string and backwards via an array converter.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class KadaJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\PopisKada\Kada An object or an array of objects of type "PopisKada\Kada"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \PopisKada\KadaArrayConverter::fromArrayList($obj, $allowNullValues)
            : \PopisKada\KadaArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\PopisKada\Kada An object or an array of objects of type "PopisKada\Kada"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \PopisKada\KadaArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}