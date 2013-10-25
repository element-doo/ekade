<?php
namespace ImageLoad;

require_once __DIR__.'/ZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageLoad\Zahtjev into a JSON string and backwards via an array converter.
 *
 * @package ImageLoad
 * @version 0.9.9 beta
 */
abstract class ZahtjevJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\ImageLoad\Zahtjev An object or an array of objects of type "ImageLoad\Zahtjev"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \ImageLoad\ZahtjevArrayConverter::fromArrayList($obj, $allowNullValues)
            : \ImageLoad\ZahtjevArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\ImageLoad\Zahtjev An object or an array of objects of type "ImageLoad\Zahtjev"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \ImageLoad\ZahtjevArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
