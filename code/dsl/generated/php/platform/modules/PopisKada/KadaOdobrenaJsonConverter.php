<?php
namespace PopisKada;

require_once __DIR__.'/KadaOdobrenaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\KadaOdobrena into a JSON string and backwards via an array converter.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class KadaOdobrenaJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\PopisKada\KadaOdobrena An object or an array of objects of type "PopisKada\KadaOdobrena"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \PopisKada\KadaOdobrenaArrayConverter::fromArrayList($obj, $allowNullValues)
            : \PopisKada\KadaOdobrenaArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\PopisKada\KadaOdobrena An object or an array of objects of type "PopisKada\KadaOdobrena"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \PopisKada\KadaOdobrenaArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
