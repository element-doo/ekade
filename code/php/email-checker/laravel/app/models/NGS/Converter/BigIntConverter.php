<?php
namespace NGS\Converter;

require_once(__DIR__.'/ConverterInterface.php');
require_once(__DIR__.'/../BigInt.php');

class BigIntConverter implements ConverterInterface
{
    public static function toJson($value = null)
    {
        return $value === null ? null : (string) $value;
    }

    public static function fromJson($value)
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException('Cannot convert JSON value to BigInt. Value is not string');
        }

        return new BigInt($value);
    }
}
