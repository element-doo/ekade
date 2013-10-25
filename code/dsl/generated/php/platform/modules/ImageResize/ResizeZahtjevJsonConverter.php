<?php
namespace ImageResize;

require_once __DIR__.'/ResizeZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageResize\ResizeZahtjev into a JSON string and backwards via an array converter.
 *
 * @package ImageResize
 * @version 0.9.9 beta
 */
abstract class ResizeZahtjevJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\ImageResize\ResizeZahtjev An object or an array of objects of type "ImageResize\ResizeZahtjev"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \ImageResize\ResizeZahtjevArrayConverter::fromArrayList($obj, $allowNullValues)
            : \ImageResize\ResizeZahtjevArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\ImageResize\ResizeZahtjev An object or an array of objects of type "ImageResize\ResizeZahtjev"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \ImageResize\ResizeZahtjevArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
