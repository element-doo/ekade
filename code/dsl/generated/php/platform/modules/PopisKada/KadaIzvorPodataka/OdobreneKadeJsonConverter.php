<?php
namespace PopisKada\KadaIzvorPodataka;

require_once __DIR__.'/OdobreneKadeArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\KadaIzvorPodataka\OdobreneKade into a JSON string and backwards via an array converter.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class OdobreneKadeJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\PopisKada\KadaIzvorPodataka\OdobreneKade An object or an array of objects of type "PopisKada\KadaIzvorPodataka\OdobreneKade"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \PopisKada\KadaIzvorPodataka\OdobreneKadeArrayConverter::fromArrayList($obj, $allowNullValues)
            : \PopisKada\KadaIzvorPodataka\OdobreneKadeArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\PopisKada\KadaIzvorPodataka\OdobreneKade An object or an array of objects of type "PopisKada\KadaIzvorPodataka\OdobreneKade"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \PopisKada\KadaIzvorPodataka\OdobreneKadeArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
