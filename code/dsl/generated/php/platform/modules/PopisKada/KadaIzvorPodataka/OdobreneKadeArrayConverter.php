<?php
namespace PopisKada\KadaIzvorPodataka;

require_once __DIR__.'/OdobreneKade.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class PopisKada\KadaIzvorPodataka\OdobreneKade into a simple array and backwards.
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
abstract class OdobreneKadeArrayConverter
{/**
     * @param array|\PopisKada\KadaIzvorPodataka\OdobreneKade An object or an array of objects of type "PopisKada\KadaIzvorPodataka\OdobreneKade"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \PopisKada\KadaIzvorPodataka\OdobreneKade)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "PopisKada\KadaIzvorPodataka\OdobreneKade" nor an array of said instances!');
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
                if (!$val instanceof \PopisKada\KadaIzvorPodataka\OdobreneKade)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "PopisKada\KadaIzvorPodataka\OdobreneKade"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \PopisKada\KadaIzvorPodataka\OdobreneKade)
            return $item;
        if (is_array($item))
            return new \PopisKada\KadaIzvorPodataka\OdobreneKade($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "PopisKada\KadaIzvorPodataka\OdobreneKade" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \PopisKada\KadaIzvorPodataka\OdobreneKade)
                    $val = new \PopisKada\KadaIzvorPodataka\OdobreneKade($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "PopisKada\KadaIzvorPodataka\OdobreneKade"!', 42, $e);
        }

        return $items;
    }
}