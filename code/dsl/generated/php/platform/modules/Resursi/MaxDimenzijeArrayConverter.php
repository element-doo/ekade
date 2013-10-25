<?php
namespace Resursi;

require_once __DIR__.'/MaxDimenzije.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Resursi\MaxDimenzije into a simple array and backwards.
 *
 * @package Resursi
 * @version 0.9.9 beta
 */
abstract class MaxDimenzijeArrayConverter
{/**
     * @param array|\Resursi\MaxDimenzije An object or an array of objects of type "Resursi\MaxDimenzije"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \Resursi\MaxDimenzije)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "Resursi\MaxDimenzije" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['URI'] = $item->URI;
        $ret['ID'] = $item->ID;
        $ret['width'] = $item->width;
        $ret['height'] = $item->height;
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
                if (!$val instanceof \Resursi\MaxDimenzije)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "Resursi\MaxDimenzije"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \Resursi\MaxDimenzije)
            return $item;
        if (is_array($item))
            return new \Resursi\MaxDimenzije($item, 'build_internal');

        throw new \InvalidArgumentException('Argument was not an instance of class "Resursi\MaxDimenzije" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \Resursi\MaxDimenzije)
                    $val = new \Resursi\MaxDimenzije($val, 'build_internal');
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "Resursi\MaxDimenzije"!', 42, $e);
        }

        return $items;
    }
}
