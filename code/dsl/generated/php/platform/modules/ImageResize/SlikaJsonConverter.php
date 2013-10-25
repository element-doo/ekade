<?php
namespace ImageResize;

require_once __DIR__.'/SlikaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageResize\Slika into a JSON string and backwards via an array converter.
 *
 * @package ImageResize
 * @version 0.9.9 beta
 */
abstract class SlikaJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\ImageResize\Slika An object or an array of objects of type "ImageResize\Slika"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \ImageResize\SlikaArrayConverter::fromArrayList($obj, $allowNullValues)
            : \ImageResize\SlikaArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\ImageResize\Slika An object or an array of objects of type "ImageResize\Slika"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \ImageResize\SlikaArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
