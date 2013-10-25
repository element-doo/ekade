<?php
namespace ImageResize;

require_once __DIR__.'/OdgovorArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageResize\Odgovor into a JSON string and backwards via an array converter.
 *
 * @package ImageResize
 * @version 0.9.9 beta
 */
abstract class OdgovorJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\ImageResize\Odgovor An object or an array of objects of type "ImageResize\Odgovor"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \ImageResize\OdgovorArrayConverter::fromArrayList($obj, $allowNullValues)
            : \ImageResize\OdgovorArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\ImageResize\Odgovor An object or an array of objects of type "ImageResize\Odgovor"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \ImageResize\OdgovorArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
