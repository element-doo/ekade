<?php
namespace Mailer;

require_once __DIR__.'/MailMessageArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Mailer\MailMessage into a JSON string and backwards via an array converter.
 *
 * @package Mailer
 * @version 0.9.9 beta
 */
abstract class MailMessageJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\Mailer\MailMessage An object or an array of objects of type "Mailer\MailMessage"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \Mailer\MailMessageArrayConverter::fromArrayList($obj, $allowNullValues)
            : \Mailer\MailMessageArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\Mailer\MailMessage An object or an array of objects of type "Mailer\MailMessage"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \Mailer\MailMessageArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}