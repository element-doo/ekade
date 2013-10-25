<?php
namespace ImageResize;

require_once __DIR__.'/Odgovor.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageResize\Odgovor into a simple array and backwards.
 *
 * @package ImageResize
 * @version 0.9.9 beta
 */
abstract class OdgovorArrayConverter
{/**
     * @param array|\ImageResize\Odgovor An object or an array of objects of type "ImageResize\Odgovor"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \ImageResize\Odgovor)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageResize\Odgovor" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['odgovori'] = \ImageResize\SlikaArrayConverter::toArray($item->odgovori, false);
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
                if (!$val instanceof \ImageResize\Odgovor)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "ImageResize\Odgovor"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \ImageResize\Odgovor)
            return $item;
        if (is_array($item))
            return new \ImageResize\Odgovor($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageResize\Odgovor" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \ImageResize\Odgovor)
                    $val = new \ImageResize\Odgovor($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "ImageResize\Odgovor"!', 42, $e);
        }

        return $items;
    }
}
