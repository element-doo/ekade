<?php
namespace NGS\Converter;

require_once(__DIR__.'/ConverterInterface.php');
require_once(__DIR__.'/../Utils.php');
require_once(__DIR__.'/../Money.php');

use NGS\Money;
use NGS\Utils;

class MoneyConverter implements ConverterInterface
{
    public static function toJson($value = null)
    {
        return $value->value === null ? null : (float) $value->value;
    }

    public static function fromJson($value)
    {
        if ($value === null) {
            return null;
        }

        if (!is_string($value) || !is_float($value)) {
            throw new \InvalidArgumentException('Cannot convert JSON value to Money. Value was not string or float, type was: "'.Utils::getType($value).'"');
        }

        return new Money($value);
    }
}
