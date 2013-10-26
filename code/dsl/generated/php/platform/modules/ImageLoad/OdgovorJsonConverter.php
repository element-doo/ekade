<?php
namespace ImageLoad;

require_once __DIR__.'/OdgovorArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageLoad\Odgovor into a JSON string and backwards via an array converter.
 *
 * @package ImageLoad
 * @version 0.9.9 beta
 */
abstract class OdgovorJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\ImageLoad\Odgovor An object or an array of objects of type "ImageLoad\Odgovor"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \ImageLoad\OdgovorArrayConverter::fromArrayList($obj, $allowNullValues)
            : \ImageLoad\OdgovorArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\ImageLoad\Odgovor An object or an array of objects of type "ImageLoad\Odgovor"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \ImageLoad\OdgovorArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}