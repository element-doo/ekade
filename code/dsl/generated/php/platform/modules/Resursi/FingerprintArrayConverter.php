<?php
namespace Resursi;

require_once __DIR__.'/Fingerprint.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Resursi\Fingerprint into a simple array and backwards.
 *
 * @package Resursi
 * @version 0.9.9 beta
 */
abstract class FingerprintArrayConverter
{/**
     * @param array|\Resursi\Fingerprint An object or an array of objects of type "Resursi\Fingerprint"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \Resursi\Fingerprint)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "Resursi\Fingerprint" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['sha1Bytes'] = $item->sha1Bytes->__toString();
        $ret['sha1Pixels'] = $item->sha1Pixels === null ? null : $item->sha1Pixels->__toString();
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
                if (!$val instanceof \Resursi\Fingerprint)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "Resursi\Fingerprint"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \Resursi\Fingerprint)
            return $item;
        if (is_array($item))
            return new \Resursi\Fingerprint($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "Resursi\Fingerprint" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \Resursi\Fingerprint)
                    $val = new \Resursi\Fingerprint($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "Resursi\Fingerprint"!', 42, $e);
        }

        return $items;
    }
}