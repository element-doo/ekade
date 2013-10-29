<?php
namespace EmailRegistracija;

require_once __DIR__.'/OdgovorArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class EmailRegistracija\Odgovor into a JSON string and backwards via an array converter.
 *
 * @package EmailRegistracija
 * @version 0.9.9 beta
 */
abstract class OdgovorJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\EmailRegistracija\Odgovor An object or an array of objects of type "EmailRegistracija\Odgovor"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \EmailRegistracija\OdgovorArrayConverter::fromArrayList($obj, $allowNullValues)
            : \EmailRegistracija\OdgovorArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\EmailRegistracija\Odgovor An object or an array of objects of type "EmailRegistracija\Odgovor"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \EmailRegistracija\OdgovorArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}