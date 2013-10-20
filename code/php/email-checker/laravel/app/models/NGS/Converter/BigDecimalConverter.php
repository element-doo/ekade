<?php
namespace NGS\Converter;

require_once(__DIR__.'/ConverterInterface.php');
require_once(__DIR__.'/../Utils.php');
require_once(__DIR__.'/../BigDecimal.php');

use NGS\BigDecimal;
use NGS\Utils;

class BigDecimalConverter implements ConverterInterface
{
    public static function toJson($value = null)
    {
        return $value === null ? null : (string) $value;
    }

    public static function fromJson($value)
    {
        if ($value === null) {
            return null;
        }

        if (!is_string($value) || !is_float($value)) {
            throw new \InvalidArgumentException('Cannot convert JSON value to BigDecimal. Value was not string or float, type was: "'.Utils::getType($value).'"');
        }

        return new BigDecimal($value);
    }
}
