<?php
namespace NGS;

use NGS\Converter\PrimitiveConverter;

class Location
{
    protected $x;
    protected $y;

    public function __construct($x=0, $y=0)
    {
        if (is_array($x)) {
            $this->setX($x['X']);
            $this->setY($x['Y']);
        }
        elseif ($x instanceof Location) {
            $this->setX($x->x);
            $this->setY($x->y);
        }
        elseif ($x instanceof Point) {
            $this->setX($x->x);
            $this->setY($x->y);
        }
        else {
            $this->setX($x);
            $this->setY($y);
        }
    }

    /**
     * Constructs array of Locations from array of valid constructor arguments
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
                } elseif (!$val instanceof \NGS\Location) {
                    $results[] = new \NGS\Location($val);
                } else {
                    $results[] = $val;
                }
            }
        }
        catch(\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to Location!', 42, $e);
        }
        return $results;
    }

    public static function toArrayList(array $items)
    {
        $results = array();
        foreach ($items as $key => $val) {
            if ($val === null) {
                $results[] = null;
            } elseif (!$val instanceof \NGS\Location) {
                throw new \InvalidArgumentException('Value was not an instance of NGS\Location');
            } else {
                $results[] = $val->asArray();
            }
        }
        return $results;
    }

    public function asArray()
    {
        return array(
            'X' => $this->x,
            'Y' => $this->y
        );
    }

    public function __get($name)
    {
        if ($name==='x') {
            return $this->x;
        }
        if ($name==='y') {
            return $this->y;
        }
        throw new \InvalidArgumentException('Cannot use getter on invalid property '.$name.' in NGS\\Location');
    }

    public function setX($value)
    {
        $this->x = PrimitiveConverter::toFloat($value);
    }

    public function setY($value)
    {
        $this->y = PrimitiveConverter::toFloat($value);
    }

    public function __set($name, $value)
    {
        if ($name==='x') {
            $this->setX($value);
        }
        if ($name==='y') {
            $this->setY($value);
        }
        throw new \InvalidArgumentException('Cannot use setter on invalid property '.$name.' in NGS\\Location');
    }

    public function __toString()
    {
        return json_encode($this->asArray());
    }
}
