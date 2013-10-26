<?php
namespace EmailProvjera;

require_once __DIR__.'/OdgovorArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class EmailProvjera\Odgovor into a JSON string and backwards via an array converter.
 *
 * @package EmailProvjera
 * @version 0.9.9 beta
 */
abstract class OdgovorJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\EmailProvjera\Odgovor An object or an array of objects of type "EmailProvjera\Odgovor"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \EmailProvjera\OdgovorArrayConverter::fromArrayList($obj, $allowNullValues)
            : \EmailProvjera\OdgovorArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\EmailProvjera\Odgovor An object or an array of objects of type "EmailProvjera\Odgovor"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \EmailProvjera\OdgovorArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}