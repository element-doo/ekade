<?php
namespace NGS\Converter;

require_once(__DIR__.'/../Utils.php');

use InvalidArgumentException;
use NGS\Utils;

/**
 * Converts values to SimpleXmlElement php type
 */
abstract class XmlConverter
{
    public static function toXml($value)
    {
        if($value instanceof \SimpleXMLElement)
            return $value;
        if(is_string($value))
            return new \SimpleXMLElement($value);
        if(is_array($value))
            return self::build_xml($value);
        throw new InvalidArgumentException('Could not convert value '.$value.' of type "'.Utils::getType($value).'" to xml!');
    }

    public static function toXmlArray(array $items, $allowNullValues=false)
    {
        $results = array();
        try {
            foreach ($items as $key => $val) {
                if ($allowNullValues && $val===null) {
                    $results[] = null;
                } elseif ($val === null) {
                    throw new InvalidArgumentException('Null value found in provided array');
                } else {
                    $results[] = self::toXml($val);
                }
            }
        }
        catch (\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to xml!', 42, $e);
        }
        return $items;
    }

    public static function toArray($value)
    {
        if($value instanceof \SimpleXMLElement)
            return self::toArrayObject($value);
        $result = array();
        foreach($value as $key => $item) {
            try {
                if($item === null)
                    throw new InvalidArgumentException('Null value found in provided array');
                $item = self::toArrayObject($item);
            }
            catch(\Exception $e) {
                throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to xml array!', 42, $e);
            }
            $result[$key] = $item;
        }
        return $result;
    }

    private static function build_xml(array $arr) {
        $keys = array_keys($arr);
        $name = $keys[0];
        $root = $arr[$name];

        $text = is_array($root) && array_key_exists('#text', $root)
            ? $root['#text']
            : '';
        $str = '<'.$name.'>'.$text.'</'.$name.'>';
        $xml = new \SimpleXmlElement($str);

        if(is_array($root))
            self::array_to_xml($root, $xml);

        return $xml;
    }

    private static function array_to_xml(array $arr, &$xml) {
        foreach($arr as $key => $value) {
            if(strpos($key, '@', 0) === 0) {
                $xml->addAttribute(substr($key, 1), $value);
            }
            else if(is_array($value)) {
                $child_has_only_numeric_keys = true;
                $i = 0;
                foreach($value as $k=>$v)
                    if($k!==$i++)
                        $child_has_only_numeric_keys = false;

                if($child_has_only_numeric_keys) {
                    foreach($value as $k=>$v) {
                        $subnode = array_key_exists('#text', $v)
                            ? $xml->addChild("$key", $v['#text'])
                            : $xml->addChild("$key");
                        self::array_to_xml($v, $subnode);
                    }
                }
                else if(!is_numeric($key)) {
                    $subnode = array_key_exists('#text', $value)
                        ? $xml->addChild("$key", $value['#text'])
                        : $xml->addChild("$key");
                    self::array_to_xml($value, $subnode);
                }
                else {
                    self::array_to_xml($value, $xml);
                }
            }
            else if($key !== '#text')
                $xml->$key = "$value";
        }
    }

    private static function xml_to_array(\SimpleXMLElement $xml, array &$arr)
    {
        if(count($xml->attributes()) === 0
                && count($xml->children()) === 0
                && !(string)$xml) {
            $arr = null;
            return;
        }
        foreach($xml->attributes() as $key => $value) {
            $arr['@'.$key] = (string)$value;
        }
        $text = (string)$xml;
        if($text && count($xml->children()) === 0) {
            $arr['#text'] = $text;
        }
        foreach($xml->children() as $key => $value) {
            $arr[$key] = isset($arr[$key]) ? array() : false;
        }
        foreach($arr as $key=>$value)
            if($arr[$key]===false)
                unset($arr[$key]);

        foreach($xml->children() as $key => $value) {
            if(isset($arr[$key])) {
                $index = count($arr[$key]);
                $arr[$key][$index] = array();
                self::xml_to_array($value, $arr[$key][$index]);
            }
            else {
                $arr[$key] = array();
                self::xml_to_array($xml->{$key}, $arr[$key]);
            }
        }
    }

    private static function toArrayObject(\SimpleXMLElement $value)
    {
        $root = array();

        self::xml_to_array($value, $root);
        $arr = array($value->getName() => $root);
        return $arr;
    }
}
