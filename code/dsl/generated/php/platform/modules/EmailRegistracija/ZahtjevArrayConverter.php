<?php
namespace EmailRegistracija;

require_once __DIR__.'/Zahtjev.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class EmailRegistracija\Zahtjev into a simple array and backwards.
 *
 * @package EmailRegistracija
 * @version 0.9.9 beta
 */
abstract class ZahtjevArrayConverter
{/**
     * @param array|\EmailRegistracija\Zahtjev An object or an array of objects of type "EmailRegistracija\Zahtjev"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \EmailRegistracija\Zahtjev)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "EmailRegistracija\Zahtjev" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['email'] = $item->email;
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
                if (!$val instanceof \EmailRegistracija\Zahtjev)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "EmailRegistracija\Zahtjev"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \EmailRegistracija\Zahtjev)
            return $item;
        if (is_array($item))
            return new \EmailRegistracija\Zahtjev($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "EmailRegistracija\Zahtjev" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \EmailRegistracija\Zahtjev)
                    $val = new \EmailRegistracija\Zahtjev($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "EmailRegistracija\Zahtjev"!', 42, $e);
        }

        return $items;
    }
}