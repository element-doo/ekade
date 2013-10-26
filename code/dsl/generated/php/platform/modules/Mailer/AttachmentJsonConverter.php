<?php
namespace Mailer;

require_once __DIR__.'/AttachmentArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * Converts an object of class Mailer\Attachment into a JSON string and backwards via an array converter.
 *
 * @package Mailer
 * @version 0.9.9 beta
 */
abstract class AttachmentJsonConverter
{/**
     * @param string Json representation of the object(s)
     *
     * @return array|\Mailer\Attachment An object or an array of objects of type "Mailer\Attachment"
     */
    public static function fromJson($item, $allowNullValues=false)
    {
        $obj = json_decode($item, true);

        return \NGS\Utils::isJsonArray($item)
            ? \Mailer\AttachmentArrayConverter::fromArrayList($obj, $allowNullValues)
            : \Mailer\AttachmentArrayConverter::fromArray($obj);
    }

    /**
     * @param array|\Mailer\Attachment An object or an array of objects of type "Mailer\Attachment"
     *
     * @return string Json representation of the object(s)
     */
    public static function toJson($item)
    {
        $arr = \Mailer\AttachmentArrayConverter::toArray($item);
        if(is_array($item))
            return json_encode($arr);
        if(empty($arr))
            return '{}';
        return json_encode($arr);
    }
}