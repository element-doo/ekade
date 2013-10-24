<?php
namespace ImageSave;

require_once __DIR__.'/Zahtjev.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class ImageSave\Zahtjev into a simple array and backwards.
 *
 * @package ImageSave
 * @version 0.9.9 beta
 */
abstract class ZahtjevArrayConverter
{/**
     * @param array|\ImageSave\Zahtjev An object or an array of objects of type "ImageSave\Zahtjev"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \ImageSave\Zahtjev)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageSave\Zahtjev" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['kadaID'] = $item->kadaID->__toString();
        $ret['thumbnail'] = $item->thumbnail->__toString();
        $ret['original'] = $item->original->__toString();
        $ret['email'] = $item->email->__toString();
        $ret['web'] = $item->web->__toString();
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
                if (!$val instanceof \ImageSave\Zahtjev)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "ImageSave\Zahtjev"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \ImageSave\Zahtjev)
            return $item;
        if (is_array($item))
            return new \ImageSave\Zahtjev($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "ImageSave\Zahtjev" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \ImageSave\Zahtjev)
                    $val = new \ImageSave\Zahtjev($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "ImageSave\Zahtjev"!', 42, $e);
        }

        return $items;
    }
}
