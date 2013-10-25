<?php
namespace ImageProvjera;

require_once __DIR__.'/ZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageProvjera\Zahtjev into a JSON string and backwards via an array converter.
 *
 * @package ImageProvjera
 * @version 0.9.9 beta
 */
abstract class ZahtjevJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\ImageProvjera\Zahtjev An object or an array of objects of type "ImageProvjera\Zahtjev"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \ImageProvjera\ZahtjevArrayConverter::fromArrayList($obj, $allowNullValues)
            : \ImageProvjera\ZahtjevArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\ImageProvjera\Zahtjev An object or an array of objects of type "ImageProvjera\Zahtjev"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \ImageProvjera\ZahtjevArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
