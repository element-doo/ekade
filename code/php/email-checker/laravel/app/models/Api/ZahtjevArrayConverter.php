<?php
namespace Api;

require_once __DIR__.'/Zahtjev.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Api\Zahtjev into a simple array and backwards.
 *
 * @package Api
 * @version 0.9.9 beta
 */
abstract class ZahtjevArrayConverter
{/**
     * @param array|\Api\Zahtjev An object or an array of objects of type "Api\Zahtjev"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \Api\Zahtjev)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "Api\Zahtjev" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['email'] = $item->email;
        $ret['kadaID'] = $item->kadaID;
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
                if (!$val instanceof \Api\Zahtjev)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "Api\Zahtjev"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \Api\Zahtjev)
            return $item;
        if (is_array($item))
            return new \Api\Zahtjev($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "Api\Zahtjev" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \Api\Zahtjev)
                    $val = new \Api\Zahtjev($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "Api\Zahtjev"!', 42, $e);
        }

        return $items;
    }
}
