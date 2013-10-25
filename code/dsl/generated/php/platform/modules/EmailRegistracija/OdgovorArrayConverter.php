<?php
namespace EmailRegistracija;

require_once __DIR__.'/Odgovor.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class EmailRegistracija\Odgovor into a simple array and backwards.
 *
 * @package EmailRegistracija
 * @version 0.9.9 beta
 */
abstract class OdgovorArrayConverter
{/**
     * @param array|\EmailRegistracija\Odgovor An object or an array of objects of type "EmailRegistracija\Odgovor"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \EmailRegistracija\Odgovor)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "EmailRegistracija\Odgovor" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['odjavljen'] = $item->odjavljen;
        $ret['unsubscribeID'] = $item->unsubscribeID;
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
                if (!$val instanceof \EmailRegistracija\Odgovor)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "EmailRegistracija\Odgovor"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \EmailRegistracija\Odgovor)
            return $item;
        if (is_array($item))
            return new \EmailRegistracija\Odgovor($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "EmailRegistracija\Odgovor" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \EmailRegistracija\Odgovor)
                    $val = new \EmailRegistracija\Odgovor($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "EmailRegistracija\Odgovor"!', 42, $e);
        }

        return $items;
    }
}
