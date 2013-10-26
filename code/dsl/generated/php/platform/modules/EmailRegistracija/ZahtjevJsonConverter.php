<?php
namespace EmailRegistracija;

require_once __DIR__.'/ZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class EmailRegistracija\Zahtjev into a JSON string and backwards via an array converter.
 *
 * @package EmailRegistracija
 * @version 0.9.9 beta
 */
abstract class ZahtjevJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\EmailRegistracija\Zahtjev An object or an array of objects of type "EmailRegistracija\Zahtjev"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \EmailRegistracija\ZahtjevArrayConverter::fromArrayList($obj, $allowNullValues)
            : \EmailRegistracija\ZahtjevArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\EmailRegistracija\Zahtjev An object or an array of objects of type "EmailRegistracija\Zahtjev"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \EmailRegistracija\ZahtjevArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}