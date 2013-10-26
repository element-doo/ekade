<?php
namespace Mailer;

require_once __DIR__.'/MailMessage.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Mailer\MailMessage into a simple array and backwards.
 *
 * @package Mailer
 * @version 0.9.9 beta
 */
abstract class MailMessageArrayConverter
{/**
     * @param array|\Mailer\MailMessage An object or an array of objects of type "Mailer\MailMessage"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \Mailer\MailMessage)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "Mailer\MailMessage" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['URI'] = $item->URI;
        $ret['ID'] = $item->ID->__toString();
        $ret['Message'] = $item->Message;
        $ret['SentAt'] = $item->SentAt === null ? null : $item->SentAt->__toString();
        $ret['Attempts'] = $item->Attempts;
        $ret['RetriesAllowed'] = $item->RetriesAllowed;
        $ret['Errors'] = $item->Errors;
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
                if (!$val instanceof \Mailer\MailMessage)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "Mailer\MailMessage"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \Mailer\MailMessage)
            return $item;
        if (is_array($item))
            return new \Mailer\MailMessage($item, 'build_internal');

        throw new \InvalidArgumentException('Argument was not an instance of class "Mailer\MailMessage" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \Mailer\MailMessage)
                    $val = new \Mailer\MailMessage($val, 'build_internal');
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "Mailer\MailMessage"!', 42, $e);
        }

        return $items;
    }
}