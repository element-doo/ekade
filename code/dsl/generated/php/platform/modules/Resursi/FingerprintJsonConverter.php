<?php
namespace Resursi;

require_once __DIR__.'/FingerprintArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Resursi\Fingerprint into a JSON string and backwards via an array converter.
 *
 * @package Resursi
 * @version 0.9.9 beta
 */
abstract class FingerprintJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\Resursi\Fingerprint An object or an array of objects of type "Resursi\Fingerprint"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \Resursi\FingerprintArrayConverter::fromArrayList($obj, $allowNullValues)
            : \Resursi\FingerprintArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\Resursi\Fingerprint An object or an array of objects of type "Resursi\Fingerprint"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \Resursi\FingerprintArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}