<?php
namespace ImageProvjera;

require_once __DIR__.'/DimenzijeSlike.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageProvjera\DimenzijeSlike into a simple array and backwards.
 *
 * @package ImageProvjera
 * @version 0.9.9 beta
 */
abstract class DimenzijeSlikeArrayConverter
{/**
     * @param array|\ImageProvjera\DimenzijeSlike An object or an array of objects of type "ImageProvjera\DimenzijeSlike"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \ImageProvjera\DimenzijeSlike)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageProvjera\DimenzijeSlike" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
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
                if (!$val instanceof \ImageProvjera\DimenzijeSlike)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "ImageProvjera\DimenzijeSlike"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \ImageProvjera\DimenzijeSlike)
            return $item;
        if (is_array($item))
            return new \ImageProvjera\DimenzijeSlike($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageProvjera\DimenzijeSlike" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \ImageProvjera\DimenzijeSlike)
                    $val = new \ImageProvjera\DimenzijeSlike($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "ImageProvjera\DimenzijeSlike"!', 42, $e);
        }

        return $items;
    }
}
