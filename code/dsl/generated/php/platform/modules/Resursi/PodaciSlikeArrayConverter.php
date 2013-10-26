<?php
namespace Resursi;

require_once __DIR__.'/PodaciSlike.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Resursi\PodaciSlike into a simple array and backwards.
 *
 * @package Resursi
 * @version 0.9.9 beta
 */
abstract class PodaciSlikeArrayConverter
{/**
     * @param array|\Resursi\PodaciSlike An object or an array of objects of type "Resursi\PodaciSlike"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \Resursi\PodaciSlike)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "Resursi\PodaciSlike" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['ime'] = $item->ime;
        $ret['format'] = $item->format;
        $ret['width'] = $item->width;
        $ret['height'] = $item->height;
        $ret['size'] = $item->size;
        $ret['filename'] = $item->filename;
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
                if (!$val instanceof \Resursi\PodaciSlike)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "Resursi\PodaciSlike"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \Resursi\PodaciSlike)
            return $item;
        if (is_array($item))
            return new \Resursi\PodaciSlike($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "Resursi\PodaciSlike" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \Resursi\PodaciSlike)
                    $val = new \Resursi\PodaciSlike($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "Resursi\PodaciSlike"!', 42, $e);
        }

        return $items;
    }
}