<?php
namespace PopisKada;

require_once __DIR__.'/ModeriranaKadaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\ModeriranaKada into a JSON string and backwards via an array converter.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class ModeriranaKadaJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\PopisKada\ModeriranaKada An object or an array of objects of type "PopisKada\ModeriranaKada"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \PopisKada\ModeriranaKadaArrayConverter::fromArrayList($obj, $allowNullValues)
            : \PopisKada\ModeriranaKadaArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\PopisKada\ModeriranaKada An object or an array of objects of type "PopisKada\ModeriranaKada"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \PopisKada\ModeriranaKadaArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
