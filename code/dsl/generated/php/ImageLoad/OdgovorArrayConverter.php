<?php
namespace ImageLoad;

require_once __DIR__.'/Odgovor.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageLoad\Odgovor into a simple array and backwards.
 *
 * @package ImageLoad
 * @version 0.9.9 beta
 */
abstract class OdgovorArrayConverter
{/**
     * @param array|\ImageLoad\Odgovor An object or an array of objects of type "ImageLoad\Odgovor"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \ImageLoad\Odgovor)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageLoad\Odgovor" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['podaciSlike'] = \Resursi\PodaciSlikeArrayConverter::toArray($item->podaciSlike);
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
                if (!$val instanceof \ImageLoad\Odgovor)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "ImageLoad\Odgovor"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \ImageLoad\Odgovor)
            return $item;
        if (is_array($item))
            return new \ImageLoad\Odgovor($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageLoad\Odgovor" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \ImageLoad\Odgovor)
                    $val = new \ImageLoad\Odgovor($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "ImageLoad\Odgovor"!', 42, $e);
        }

        return $items;
    }
}
