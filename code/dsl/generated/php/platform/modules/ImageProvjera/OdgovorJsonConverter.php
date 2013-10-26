<?php
namespace ImageProvjera;

require_once __DIR__.'/OdgovorArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageProvjera\Odgovor into a JSON string and backwards via an array converter.
 *
 * @package ImageProvjera
 * @version 0.9.9 beta
 */
abstract class OdgovorJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\ImageProvjera\Odgovor An object or an array of objects of type "ImageProvjera\Odgovor"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \ImageProvjera\OdgovorArrayConverter::fromArrayList($obj, $allowNullValues)
            : \ImageProvjera\OdgovorArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\ImageProvjera\Odgovor An object or an array of objects of type "ImageProvjera\Odgovor"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \ImageProvjera\OdgovorArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}