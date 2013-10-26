<?php
namespace Sigurnost;

require_once __DIR__.'/RegistracijaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Sigurnost\Registracija into a JSON string and backwards via an array converter.
 *
 * @package Sigurnost
 * @version 0.9.9 beta
 */
abstract class RegistracijaJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\Sigurnost\Registracija An object or an array of objects of type "Sigurnost\Registracija"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \Sigurnost\RegistracijaArrayConverter::fromArrayList($obj, $allowNullValues)
            : \Sigurnost\RegistracijaArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\Sigurnost\Registracija An object or an array of objects of type "Sigurnost\Registracija"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \Sigurnost\RegistracijaArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}