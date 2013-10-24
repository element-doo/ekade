<?php
namespace ImageSave;

require_once __DIR__.'/ZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageSave\Zahtjev into a JSON string and backwards via an array converter.
 *
 * @package ImageSave
 * @version 0.9.9 beta
 */
abstract class ZahtjevJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\ImageSave\Zahtjev An object or an array of objects of type "ImageSave\Zahtjev"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \ImageSave\ZahtjevArrayConverter::fromArrayList($obj, $allowNullValues)
            : \ImageSave\ZahtjevArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\ImageSave\Zahtjev An object or an array of objects of type "ImageSave\Zahtjev"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \ImageSave\ZahtjevArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
