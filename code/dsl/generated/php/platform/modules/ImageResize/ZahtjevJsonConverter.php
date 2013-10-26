<?php
namespace ImageResize;

require_once __DIR__.'/ZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageResize\Zahtjev into a JSON string and backwards via an array converter.
 *
 * @package ImageResize
 * @version 0.9.9 beta
 */
abstract class ZahtjevJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\ImageResize\Zahtjev An object or an array of objects of type "ImageResize\Zahtjev"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \ImageResize\ZahtjevArrayConverter::fromArrayList($obj, $allowNullValues)
            : \ImageResize\ZahtjevArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\ImageResize\Zahtjev An object or an array of objects of type "ImageResize\Zahtjev"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \ImageResize\ZahtjevArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}