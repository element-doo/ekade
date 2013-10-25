<?php
namespace PopisKada;

require_once __DIR__.'/KadaOdbijenaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\KadaOdbijena into a JSON string and backwards via an array converter.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class KadaOdbijenaJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\PopisKada\KadaOdbijena An object or an array of objects of type "PopisKada\KadaOdbijena"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \PopisKada\KadaOdbijenaArrayConverter::fromArrayList($obj, $allowNullValues)
            : \PopisKada\KadaOdbijenaArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\PopisKada\KadaOdbijena An object or an array of objects of type "PopisKada\KadaOdbijena"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \PopisKada\KadaOdbijenaArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}