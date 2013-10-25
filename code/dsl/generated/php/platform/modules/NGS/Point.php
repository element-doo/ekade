<?php
namespace NGS;

use NGS\Location;
use NGS\Converter\PrimitiveConverter;

class Point extends Location
{
    public function __construct($x=0, $y=0)
    {
        if (is_string($x) && strpos($x, ',')) {
            $parts = explode(',', $x);
            if (count($parts) !== 2) {
                throw new \InvalidArgumentException('Cannot construct point from invalid format: "'.$x.'"');
            }
            if (filter_var($parts[0], FILTER_VALIDATE_INT) === false
                || filter_var($parts[1], FILTER_VALIDATE_INT) === false) {
                throw new \InvalidArgumentException('Cannot construct point from invalid format: "'.$x.'"');
            }
            $this->setX($parts[0]);
            $this->setY($parts[1]);
        } else {
            parent::__construct($x, $y);
        }
    }

    /**
     * Constructs array of Points from array of valid constructor arguments
     *
     * @param array $items
     * @return array
     * @throws \InvalidArgumentException
     */
    public static function toArray(array $items, $allowNullValues=false)
    {
        $results = array();
        try {
            foreach ($items as $key => $val) {
                if ($allowNullValues && $val===null) {
                    $results[] = null;
                } elseif ($val === null) {
                    throw new \InvalidArgumentException('Null value found in provided array');
                } elseif (!$val instanceof \NGS\Point) {
                    $results[] = new \NGS\Point($val);
                } else {
                    $results[] = $val;
                }
            }
        }
        catch(\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to Location: '.$e->getMessage(), 42, $e);
        }
        return $results;
    }

    public function setX($value)
    {
        $this->x = PrimitiveConverter::toInteger($value);
    }

    public function setY($value)
    {
        $this->y = PrimitiveConverter::toInteger($value);
    }

    public function __toString()
    {
        return "{$this->x},{$this->y}";
    }
}
