<?php
namespace EmailProvjera;

require_once __DIR__.'/ZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class EmailProvjera\Zahtjev into a JSON string and backwards via an array converter.
 *
 * @package EmailProvjera
 * @version 0.9.9 beta
 */
abstract class ZahtjevJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\EmailProvjera\Zahtjev An object or an array of objects of type "EmailProvjera\Zahtjev"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \EmailProvjera\ZahtjevArrayConverter::fromArrayList($obj, $allowNullValues)
            : \EmailProvjera\ZahtjevArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\EmailProvjera\Zahtjev An object or an array of objects of type "EmailProvjera\Zahtjev"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \EmailProvjera\ZahtjevArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
