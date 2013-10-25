<?php
namespace NGS\Patterns;

require_once(__DIR__.'/AggregateRoot.php');
require_once(__DIR__.'/../Timestamp.php');
require_once(__DIR__.'/../Converter/PrimitiveConverter.php');

use NGS\Converter\PrimitiveConverter;
use NGS\Timestamp;

class Snapshot
{
    protected $at;
    protected $action;
    protected $value;

    public function __construct($at, $action, AggregateRoot $value)
    {
        $this->at = new Timestamp($at);
        $this->action = PrimitiveConverter::toString($action);
        $this->value = $value;
    }

    public function getAt()
    {
        return $this->at;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __get($name)
    {
        if($name === 'at')
            return $this->at;
        if($name === 'action')
            return $this->action;
        if($name === 'value')
            return $this->value;
        throw new \InvalidArgumentException('Unknown property '.$name);
    }
}
