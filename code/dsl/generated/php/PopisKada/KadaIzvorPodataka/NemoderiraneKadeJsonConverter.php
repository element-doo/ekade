<?php
namespace PopisKada\KadaIzvorPodataka;

require_once __DIR__.'/NemoderiraneKadeArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\KadaIzvorPodataka\NemoderiraneKade into a JSON string and backwards via an array converter.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class NemoderiraneKadeJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\PopisKada\KadaIzvorPodataka\NemoderiraneKade An object or an array of objects of type "PopisKada\KadaIzvorPodataka\NemoderiraneKade"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \PopisKada\KadaIzvorPodataka\NemoderiraneKadeArrayConverter::fromArrayList($obj, $allowNullValues)
            : \PopisKada\KadaIzvorPodataka\NemoderiraneKadeArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\PopisKada\KadaIzvorPodataka\NemoderiraneKade An object or an array of objects of type "PopisKada\KadaIzvorPodataka\NemoderiraneKade"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \PopisKada\KadaIzvorPodataka\NemoderiraneKadeArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
