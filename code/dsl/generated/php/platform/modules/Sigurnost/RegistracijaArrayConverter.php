<?php
namespace Sigurnost;

require_once __DIR__.'/Registracija.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Sigurnost\Registracija into a simple array and backwards.
 *
 * @package Sigurnost
 * @version 0.9.9 beta
 */
abstract class RegistracijaArrayConverter
{/**
     * @param array|\Sigurnost\Registracija An object or an array of objects of type "Sigurnost\Registracija"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \Sigurnost\Registracija)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "Sigurnost\Registracija" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['URI'] = $item->URI;
        $ret['username'] = $item->username;
        $ret['sifra'] = $item->sifra;
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
                if (!$val instanceof \Sigurnost\Registracija)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "Sigurnost\Registracija"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \Sigurnost\Registracija)
            return $item;
        if (is_array($item))
            return new \Sigurnost\Registracija($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "Sigurnost\Registracija" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \Sigurnost\Registracija)
                    $val = new \Sigurnost\Registracija($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "Sigurnost\Registracija"!', 42, $e);
        }

        return $items;
    }
}