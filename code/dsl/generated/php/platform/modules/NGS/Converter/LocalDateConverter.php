<?php
namespace NGS\Converter;

require_once(__DIR__.'/ConverterInterface.php');
require_once(__DIR__.'/../Utils.php');
require_once(__DIR__.'/../LocalDate.php');

use NGS\LocalDate;
use NGS\Utils;

class LocalDateConverter implements ConverterInterface
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

        if (!is_string($value)) {
            throw new \InvalidArgumentException('Cannot convert JSON value to LocalDate. Value was not string, type was: "'.Utils::getType($value).'"');
        }

        return new LocalDate($value);
    }
}
