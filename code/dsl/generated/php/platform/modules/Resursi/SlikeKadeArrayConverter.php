<?php
namespace Resursi;

require_once __DIR__.'/SlikeKade.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Resursi\SlikeKade into a simple array and backwards.
 *
 * @package Resursi
 * @version 0.9.9 beta
 */
abstract class SlikeKadeArrayConverter
{/**
     * @param array|\Resursi\SlikeKade An object or an array of objects of type "Resursi\SlikeKade"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \Resursi\SlikeKade)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "Resursi\SlikeKade" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['URI'] = $item->URI;
        $ret['ID'] = $item->ID->__toString();
        if($item->digest !== null)
            $ret['digest'] = \Resursi\FingerprintArrayConverter::toArray($item->digest);
        if($item->original !== null)
            $ret['original'] = \Resursi\PodaciSlikeArrayConverter::toArray($item->original);
        if($item->web !== null)
            $ret['web'] = \Resursi\PodaciSlikeArrayConverter::toArray($item->web);
        if($item->email !== null)
            $ret['email'] = \Resursi\PodaciSlikeArrayConverter::toArray($item->email);
        if($item->thumbnail !== null)
            $ret['thumbnail'] = \Resursi\PodaciSlikeArrayConverter::toArray($item->thumbnail);
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
                if (!$val instanceof \Resursi\SlikeKade)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "Resursi\SlikeKade"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \Resursi\SlikeKade)
            return $item;
        if (is_array($item))
            return new \Resursi\SlikeKade($item, 'build_internal');

        throw new \InvalidArgumentException('Argument was not an instance of class "Resursi\SlikeKade" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \Resursi\SlikeKade)
                    $val = new \Resursi\SlikeKade($val, 'build_internal');
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "Resursi\SlikeKade"!', 42, $e);
        }

        return $items;
    }
}
