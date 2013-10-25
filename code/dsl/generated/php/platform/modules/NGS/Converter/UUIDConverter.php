<?php
namespace NGS\Converter;

require_once(__DIR__.'/ConverterInterface.php');
require_once(__DIR__.'/../Utils.php');
require_once(__DIR__.'/../UUID.php');

use NGS\UUID;
use NGS\Utils;

class UUIDConverter implements ConverterInterface
{
    public static function toJson($value = null)
    {
        return $value === null ? null : (string) $value;
    }

    public static function fromJson($value)
    {
        if($value === null) {
            return null;
        }
        if(!is_string($value)) {
            throw new \InvalidArgumentException('Cannot convert JSON value to UUID. Value type was not string, type was: "'.Utils::getType($value).'"');
        }
        return new UUID($value);
    }
}
