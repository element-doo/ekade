<?php
namespace NGS\Patterns;

use \NGS\Converter\PrimitiveConverter;

abstract class Search
{
    protected $limit;
    protected $offset;
    protected $order = array();

    public abstract function search();

    public function limit($limit) { return $this->take($limit); }
    public function take($limit)
    {
        $this->limit = PrimitiveConverter::toInteger($limit);
        return $this;
    }

    public function offset($offset) { return $this->skip($offset); }
    public function skip($offset)
    {
        $this->offset = PrimitiveConverter::toInteger($offset);
        return $this;
    }

    public function asc($property) { return $this->ascending($property); }
    public function ascending($property)
    {
        $this->order[PrimitiveConverter::toString($property)] = true;
        return $this;
    }

    public function desc($property) { return $this->descending($property); }
    public function descending($property)
    {
        $this->order[PrimitiveConverter::toString($property)] = false;
        return $this;
    }
}
