<?php
namespace Resursi;

require_once __DIR__.'/PodaciSlikeArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Resursi\PodaciSlike into a JSON string and backwards via an array converter.
 *
 * @package Resursi
 * @version 0.9.9 beta
 */
abstract class PodaciSlikeJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\Resursi\PodaciSlike An object or an array of objects of type "Resursi\PodaciSlike"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \Resursi\PodaciSlikeArrayConverter::fromArrayList($obj, $allowNullValues)
            : \Resursi\PodaciSlikeArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\Resursi\PodaciSlike An object or an array of objects of type "Resursi\PodaciSlike"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \Resursi\PodaciSlikeArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}