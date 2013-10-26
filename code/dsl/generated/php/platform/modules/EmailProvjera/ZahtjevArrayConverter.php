<?php
namespace EmailProvjera;

require_once __DIR__.'/Zahtjev.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class EmailProvjera\Zahtjev into a simple array and backwards.
 *
 * @package EmailProvjera
 * @version 0.9.9 beta
 */
abstract class ZahtjevArrayConverter
{/**
     * @param array|\EmailProvjera\Zahtjev An object or an array of objects of type "EmailProvjera\Zahtjev"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \EmailProvjera\Zahtjev)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "EmailProvjera\Zahtjev" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['email'] = $item->email;
        $ret['kadaID'] = $item->kadaID === null ? null : $item->kadaID->__toString();
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
                if (!$val instanceof \EmailProvjera\Zahtjev)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "EmailProvjera\Zahtjev"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \EmailProvjera\Zahtjev)
            return $item;
        if (is_array($item))
            return new \EmailProvjera\Zahtjev($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "EmailProvjera\Zahtjev" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \EmailProvjera\Zahtjev)
                    $val = new \EmailProvjera\Zahtjev($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "EmailProvjera\Zahtjev"!', 42, $e);
        }

        return $items;
    }
}