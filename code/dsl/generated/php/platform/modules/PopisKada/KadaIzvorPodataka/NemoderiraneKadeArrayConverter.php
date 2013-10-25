<?php
namespace PopisKada\KadaIzvorPodataka;

require_once __DIR__.'/NemoderiraneKade.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\KadaIzvorPodataka\NemoderiraneKade into a simple array and backwards.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class NemoderiraneKadeArrayConverter
{/**
     * @param array|\PopisKada\KadaIzvorPodataka\NemoderiraneKade An object or an array of objects of type "PopisKada\KadaIzvorPodataka\NemoderiraneKade"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \PopisKada\KadaIzvorPodataka\NemoderiraneKade)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "PopisKada\KadaIzvorPodataka\NemoderiraneKade" nor an array of said instances!');
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
                if (!$val instanceof \PopisKada\KadaIzvorPodataka\NemoderiraneKade)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "PopisKada\KadaIzvorPodataka\NemoderiraneKade"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \PopisKada\KadaIzvorPodataka\NemoderiraneKade)
            return $item;
        if (is_array($item))
            return new \PopisKada\KadaIzvorPodataka\NemoderiraneKade($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "PopisKada\KadaIzvorPodataka\NemoderiraneKade" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \PopisKada\KadaIzvorPodataka\NemoderiraneKade)
                    $val = new \PopisKada\KadaIzvorPodataka\NemoderiraneKade($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "PopisKada\KadaIzvorPodataka\NemoderiraneKade"!', 42, $e);
        }

        return $items;
    }
}
