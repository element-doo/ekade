<?php
namespace ImageProvjera;

require_once __DIR__.'/DimenzijeSlikeArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageProvjera\DimenzijeSlike into a JSON string and backwards via an array converter.
 *
 * @package ImageProvjera
 * @version 0.9.9 beta
 */
abstract class DimenzijeSlikeJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\ImageProvjera\DimenzijeSlike An object or an array of objects of type "ImageProvjera\DimenzijeSlike"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \ImageProvjera\DimenzijeSlikeArrayConverter::fromArrayList($obj, $allowNullValues)
            : \ImageProvjera\DimenzijeSlikeArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\ImageProvjera\DimenzijeSlike An object or an array of objects of type "ImageProvjera\DimenzijeSlike"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \ImageProvjera\DimenzijeSlikeArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}