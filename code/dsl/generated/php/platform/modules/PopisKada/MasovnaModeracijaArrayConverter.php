<?php
namespace PopisKada;

require_once __DIR__.'/MasovnaModeracija.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\MasovnaModeracija into a simple array and backwards.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class MasovnaModeracijaArrayConverter
{/**
     * @param array|\PopisKada\MasovnaModeracija An object or an array of objects of type "PopisKada\MasovnaModeracija"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \PopisKada\MasovnaModeracija)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "PopisKada\MasovnaModeracija" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['URI'] = $item->URI;
        $ret['moderacijeKada'] = \PopisKada\ModeriranaKadaArrayConverter::toArray($item->moderacijeKada, false);
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
                if (!$val instanceof \PopisKada\MasovnaModeracija)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "PopisKada\MasovnaModeracija"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \PopisKada\MasovnaModeracija)
            return $item;
        if (is_array($item))
            return new \PopisKada\MasovnaModeracija($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "PopisKada\MasovnaModeracija" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \PopisKada\MasovnaModeracija)
                    $val = new \PopisKada\MasovnaModeracija($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "PopisKada\MasovnaModeracija"!', 42, $e);
        }

        return $items;
    }
}
