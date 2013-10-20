<?php
namespace Api;

require_once __DIR__.'/ZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Api\Zahtjev into a JSON string and backwards via an array converter.
 *
 * @package Api
 * @version 0.9.9 beta
 */
abstract class ZahtjevJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\Api\Zahtjev An object or an array of objects of type "Api\Zahtjev"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \Api\ZahtjevArrayConverter::fromArrayList($obj, $allowNullValues)
            : \Api\ZahtjevArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\Api\Zahtjev An object or an array of objects of type "Api\Zahtjev"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \Api\ZahtjevArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
