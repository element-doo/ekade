<?php
namespace ImageSave;

require_once __DIR__.'/Odgovor.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageSave\Odgovor into a simple array and backwards.
 *
 * @package ImageSave
 * @version 0.9.9 beta
 */
abstract class OdgovorArrayConverter
{/**
     * @param array|\ImageSave\Odgovor An object or an array of objects of type "ImageSave\Odgovor"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \ImageSave\Odgovor)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageSave\Odgovor" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
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
                if (!$val instanceof \ImageSave\Odgovor)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "ImageSave\Odgovor"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \ImageSave\Odgovor)
            return $item;
        if (is_array($item))
            return new \ImageSave\Odgovor($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageSave\Odgovor" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \ImageSave\Odgovor)
                    $val = new \ImageSave\Odgovor($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "ImageSave\Odgovor"!', 42, $e);
        }

        return $items;
    }
}