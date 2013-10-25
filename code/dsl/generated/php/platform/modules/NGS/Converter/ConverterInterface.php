<?php
namespace NGS\Converter;

interface ConverterInterface
{
    public static function toJson($object = null);

    public static function fromJson($json);
}
