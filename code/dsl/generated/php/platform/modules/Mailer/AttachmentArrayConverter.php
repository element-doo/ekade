<?php
namespace Mailer;

require_once __DIR__.'/Attachment.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Mailer\Attachment into a simple array and backwards.
 *
 * @package Mailer
 * @version 0.9.9 beta
 */
abstract class AttachmentArrayConverter
{/**
     * @param array|\Mailer\Attachment An object or an array of objects of type "Mailer\Attachment"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \Mailer\Attachment)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "Mailer\Attachment" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['fileName'] = $item->fileName;
        $ret['mimeType'] = $item->mimeType;
        $ret['bytes'] = $item->bytes->__toString();
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
                if (!$val instanceof \Mailer\Attachment)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "Mailer\Attachment"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \Mailer\Attachment)
            return $item;
        if (is_array($item))
            return new \Mailer\Attachment($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "Mailer\Attachment" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \Mailer\Attachment)
                    $val = new \Mailer\Attachment($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "Mailer\Attachment"!', 42, $e);
        }

        return $items;
    }
}