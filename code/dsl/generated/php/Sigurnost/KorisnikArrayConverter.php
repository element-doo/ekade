<?php
namespace Sigurnost;

require_once __DIR__.'/Korisnik.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Sigurnost\Korisnik into a simple array and backwards.
 *
 * @package Sigurnost
 * @version 0.9.9 beta
 */
abstract class KorisnikArrayConverter
{/**
     * @param array|\Sigurnost\Korisnik An object or an array of objects of type "Sigurnost\Korisnik"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \Sigurnost\Korisnik)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "Sigurnost\Korisnik" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['URI'] = $item->URI;
        $ret['ID'] = $item->ID;
        $ret['username'] = $item->username;
        $ret['salt'] = $item->salt;
        $ret['hashSifra'] = $item->hashSifra->__toString();
        return $ret;
    }

    private static function toArrayList(array $items, $allowNullValues=false)
    {
        $ret = array();

        foreach($items as $key => $val) {
            if ($allowNullValues && $val===null) {
                $ret[] = null;
            }
            else {
                if (!$val instanceof \Sigurnost\Korisnik)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "Sigurnost\Korisnik"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \Sigurnost\Korisnik)
            return $item;
        if (is_array($item))
            return new \Sigurnost\Korisnik($item, 'build_internal');

        throw new \InvalidArgumentException('Argument was not an instance of class "Sigurnost\Korisnik" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \Sigurnost\Korisnik)
                    $val = new \Sigurnost\Korisnik($val, 'build_internal');
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "Sigurnost\Korisnik"!', 42, $e);
        }

        return $items;
    }
}
