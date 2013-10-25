<?php
namespace Sigurnost;

require_once __DIR__.'/KorisnikArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Sigurnost\Korisnik into a JSON string and backwards via an array converter.
 *
 * @package Sigurnost
 * @version 0.9.9 beta
 */
abstract class KorisnikJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\Sigurnost\Korisnik An object or an array of objects of type "Sigurnost\Korisnik"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \Sigurnost\KorisnikArrayConverter::fromArrayList($obj, $allowNullValues)
            : \Sigurnost\KorisnikArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\Sigurnost\Korisnik An object or an array of objects of type "Sigurnost\Korisnik"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \Sigurnost\KorisnikArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}
