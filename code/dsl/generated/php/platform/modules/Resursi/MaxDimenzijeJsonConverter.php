<?php
namespace Resursi;

require_once __DIR__.'/MaxDimenzijeArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Resursi\MaxDimenzije into a JSON string and backwards via an array converter.
 *
 * @package Resursi
 * @version 0.9.9 beta
 */
abstract class MaxDimenzijeJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\Resursi\MaxDimenzije An object or an array of objects of type "Resursi\MaxDimenzije"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \Resursi\MaxDimenzijeArrayConverter::fromArrayList($obj, $allowNullValues)
            : \Resursi\MaxDimenzijeArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\Resursi\MaxDimenzije An object or an array of objects of type "Resursi\MaxDimenzije"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \Resursi\MaxDimenzijeArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
