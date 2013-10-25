<?php
namespace PopisKada;

require_once __DIR__.'/MasovnaModeracijaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\MasovnaModeracija into a JSON string and backwards via an array converter.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class MasovnaModeracijaJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\PopisKada\MasovnaModeracija An object or an array of objects of type "PopisKada\MasovnaModeracija"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \PopisKada\MasovnaModeracijaArrayConverter::fromArrayList($obj, $allowNullValues)
            : \PopisKada\MasovnaModeracijaArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\PopisKada\MasovnaModeracija An object or an array of objects of type "PopisKada\MasovnaModeracija"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \PopisKada\MasovnaModeracijaArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
