<?php
namespace PopisKada;

require_once __DIR__.'/Kada.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\Kada into a simple array and backwards.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class KadaArrayConverter
{/**
     * @param array|\PopisKada\Kada An object or an array of objects of type "PopisKada\Kada"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \PopisKada\Kada)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "PopisKada\Kada" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['URI'] = $item->URI;
        $ret['ID'] = $item->ID->__toString();
        $ret['dodana'] = $item->dodana->__toString();
        $ret['odobrena'] = $item->odobrena === null ? null : $item->odobrena->__toString();
        $ret['odbijena'] = $item->odbijena === null ? null : $item->odbijena->__toString();
        $ret['brojacSlanja'] = $item->brojacSlanja;
        if($item->slikeKadeURI !== null)
            $ret['slikeKadeURI'] = $item->slikeKadeURI;
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
                if (!$val instanceof \PopisKada\Kada)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "PopisKada\Kada"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \PopisKada\Kada)
            return $item;
        if (is_array($item))
            return new \PopisKada\Kada($item, 'build_internal');

        throw new \InvalidArgumentException('Argument was not an instance of class "PopisKada\Kada" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \PopisKada\Kada)
                    $val = new \PopisKada\Kada($val, 'build_internal');
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "PopisKada\Kada"!', 42, $e);
        }

        return $items;
    }
}