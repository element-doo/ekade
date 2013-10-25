<?php
namespace ImageResize;

require_once __DIR__.'/Slika.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageResize\Slika into a simple array and backwards.
 *
 * @package ImageResize
 * @version 0.9.9 beta
 */
abstract class SlikaArrayConverter
{/**
     * @param array|\ImageResize\Slika An object or an array of objects of type "ImageResize\Slika"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \ImageResize\Slika)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageResize\Slika" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['body'] = $item->body->__toString();
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
                if (!$val instanceof \ImageResize\Slika)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "ImageResize\Slika"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \ImageResize\Slika)
            return $item;
        if (is_array($item))
            return new \ImageResize\Slika($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageResize\Slika" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \ImageResize\Slika)
                    $val = new \ImageResize\Slika($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "ImageResize\Slika"!', 42, $e);
        }

        return $items;
    }
}
