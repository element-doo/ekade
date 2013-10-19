<?php
namespace PopisKada;

require_once __DIR__.'/KadaIzvorPodatakaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\KadaIzvorPodataka into a JSON string and backwards via an array converter.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class KadaIzvorPodatakaJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\PopisKada\KadaIzvorPodataka An object or an array of objects of type "PopisKada\KadaIzvorPodataka"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \PopisKada\KadaIzvorPodatakaArrayConverter::fromArrayList($obj, $allowNullValues)
            : \PopisKada\KadaIzvorPodatakaArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\PopisKada\KadaIzvorPodataka An object or an array of objects of type "PopisKada\KadaIzvorPodataka"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \PopisKada\KadaIzvorPodatakaArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
