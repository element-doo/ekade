<?php
namespace Api;

require_once __DIR__.'/OdgovorArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Api\Odgovor into a JSON string and backwards via an array converter.
 *
 * @package Api
 * @version 0.9.9 beta
 */
abstract class OdgovorJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\Api\Odgovor An object or an array of objects of type "Api\Odgovor"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \Api\OdgovorArrayConverter::fromArrayList($obj, $allowNullValues)
            : \Api\OdgovorArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\Api\Odgovor An object or an array of objects of type "Api\Odgovor"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \Api\OdgovorArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
