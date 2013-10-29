<?php
namespace Mailer;

require_once __DIR__.'/SendEmail.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Mailer\SendEmail into a simple array and backwards.
 *
 * @package Mailer
 * @version 0.9.9 beta
 */
abstract class SendEmailArrayConverter
{/**
     * @param array|\Mailer\SendEmail An object or an array of objects of type "Mailer\SendEmail"
     *
     * @return array A simple array representation
     */
    public static function toArray($item, $allowNullValues=false)
    {
        if ($item instanceof \Mailer\SendEmail)
            return self::toArrayObject($item);
        if (is_array($item))
            return self::toArrayList($item, $allowNullValues);

        throw new \InvalidArgumentException('Argument was not an instance of class "Mailer\SendEmail" nor an array of said instances!');
    }

    private static function toArrayObject($item)
    {
        $ret = array();
        $ret['URI'] = $item->URI;
        $ret['from'] = $item->from;
        $ret['to'] = $item->to;
        $ret['replyTo'] = $item->replyTo;
        $ret['cc'] = $item->cc;
        $ret['bcc'] = $item->bcc;
        $ret['subject'] = $item->subject;
        $ret['textBody'] = $item->textBody;
        $ret['htmlBody'] = $item->htmlBody;
        $ret['attachments'] = \Mailer\AttachmentArrayConverter::toArray($item->attachments, false);
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
                if (!$val instanceof \Mailer\SendEmail)
                    throw new \InvalidArgumentException('Element with index "'.$key.'" was not an object of class "Mailer\SendEmail"! Type was: '.\NGS\Utils::getType($val));

                $ret[] = $val->toArray();
            }
        }

        return $ret;
    }

    public static function fromArray($item)
    {
        if ($item instanceof \Mailer\SendEmail)
            return $item;
        if (is_array($item))
            return new \Mailer\SendEmail($item);

        throw new \InvalidArgumentException('Argument was not an instance of class "Mailer\SendEmail" nor an array of said instances!');
    }

    public static function fromArrayList(array $items, $allowNullValues=false)
    {
        try {
            foreach($items as $key => &$val) {
                if($allowNullValues && $val===null)
                    continue;
                if($val === null)
                    throw new \InvalidArgumentException('Null value found in provided array');
                if(!$val instanceof \Mailer\SendEmail)
                    $val = new \Mailer\SendEmail($val);
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to object "Mailer\SendEmail"!', 42, $e);
        }

        return $items;
    }
}