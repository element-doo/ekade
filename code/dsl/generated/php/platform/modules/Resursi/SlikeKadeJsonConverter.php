<?php
namespace Resursi;

require_once __DIR__.'/SlikeKadeArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Resursi\SlikeKade into a JSON string and backwards via an array converter.
 *
 * @package Resursi
 * @version 0.9.9 beta
 */
abstract class SlikeKadeJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\Resursi\SlikeKade An object or an array of objects of type "Resursi\SlikeKade"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \Resursi\SlikeKadeArrayConverter::fromArrayList($obj, $allowNullValues)
            : \Resursi\SlikeKadeArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\Resursi\SlikeKade An object or an array of objects of type "Resursi\SlikeKade"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \Resursi\SlikeKadeArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
