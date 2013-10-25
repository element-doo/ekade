<?php
namespace ImageResize;

require_once __DIR__.'/ResizeZahtjev.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageResize\ResizeZahtjev into a simple array and backwards.
 *
 * @package ImageResize
 * @version 0.9.9 beta
 */
abstract class ResizeZahtjevArrayConverter
{/**
     * @param array|\ImageResize\ResizeZahtjev An object or an array of objects of type "ImageResize\ResizeZahtjev"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \ImageResize\ResizeZahtjev)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageResize\ResizeZahtjev" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['width'] = $item->width;
        $ret['height'] = $item->height;
        $ret['depth'] = $item->depth;
        $ret['format'] = $item->format;
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
                if (!$val instanceof \ImageResize\ResizeZahtjev)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "ImageResize\ResizeZahtjev"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \ImageResize\ResizeZahtjev)
            return $item;
        if (is_array($item))
            return new \ImageResize\ResizeZahtjev($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageResize\ResizeZahtjev" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \ImageResize\ResizeZahtjev)
                    $val = new \ImageResize\ResizeZahtjev($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "ImageResize\ResizeZahtjev"!', 42, $e);
        }

        return $items;
    }
}
