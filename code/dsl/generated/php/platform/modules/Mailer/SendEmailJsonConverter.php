<?php
namespace Mailer;

require_once __DIR__.'/SendEmailArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Mailer\SendEmail into a JSON string and backwards via an array converter.
 *
 * @package Mailer
 * @version 0.9.9 beta
 */
abstract class SendEmailJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\Mailer\SendEmail An object or an array of objects of type "Mailer\SendEmail"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \Mailer\SendEmailArrayConverter::fromArrayList($obj, $allowNullValues)
            : \Mailer\SendEmailArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\Mailer\SendEmail An object or an array of objects of type "Mailer\SendEmail"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \Mailer\SendEmailArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}