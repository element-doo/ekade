<?php
namespace ImageSave;

require_once __DIR__.'/OdgovorArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageSave\Odgovor into a JSON string and backwards via an array converter.
 *
 * @package ImageSave
 * @version 0.9.9 beta
 */
abstract class OdgovorJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\ImageSave\Odgovor An object or an array of objects of type "ImageSave\Odgovor"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \ImageSave\OdgovorArrayConverter::fromArrayList($obj, $allowNullValues)
            : \ImageSave\OdgovorArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\ImageSave\Odgovor An object or an array of objects of type "ImageSave\Odgovor"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \ImageSave\OdgovorArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}