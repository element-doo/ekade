<?php
namespace NGS\Patterns;

require_once(__DIR__.'/../Converter/PrimitiveConverter.php');
require_once(__DIR__.'/../Client/DomainProxy.php');

use \NGS\Client\DomainProxy;
use \NGS\Converter\PrimitiveConverter;
use \NGS\Name;

/**
 * Customized search on domain object
 *
 * @method GenericSearch equals($property, $value)
 * @method GenericSearch eq($property, $value)
 * @method GenericSearch notEquals($property, $value)
 * @method GenericSearch neq($property, $value)
 * @method GenericSearch lessThan($property, $value)
 * @method GenericSearch lt($property, $value)
 * @method GenericSearch lessOrEqualThan($property, $value)
 * @method GenericSearch moreThan($property, $value)
 * @method GenericSearch gt($property, $value)
 * @method GenericSearch moreOrEqualThan($property, $value)
 * @method GenericSearch gte($property, $value)
 * @method GenericSearch valueIn($property, $value)
 * @method GenericSearch in($property, $value)
 * @method GenericSearch valueNotIn($property, $value)
 * @method GenericSearch notIn($property, $value)
 * @method GenericSearch inValue($property, $value)
 * @method GenericSearch notInValue($property, $value)
 * @method GenericSearch startsWithValue($property, $value)
 * @method GenericSearch startsWith($property, $value)
 * @method GenericSearch startsWithCaseInsensitiveValue($property, $value)
 * @method GenericSearch startsWithCI($property, $value)
 * @method GenericSearch notStartsWithValue($property, $value)
 * @method GenericSearch notStartsWith($property, $value)
 * @method GenericSearch notStartsWithCaseInsensitiveValue($property, $value)
 * @method GenericSearch notStartsWithCI($property, $value)
 * @method GenericSearch valueStartsWith($property, $value)
 * @method GenericSearch valueStartsWithCaseInsensitive($property, $value)
 * @method GenericSearch valueNotStartsWith($property, $value)
 * @method GenericSearch valueNotStartsWithCaseInsensitive($property, $value)
 */
class GenericSearch extends Search
{
    private $domainObject;
    private $filters;

    private static $filterMap = array(
        'equals' => 0,
        'eq'     => 0,

        'notEquals' => 1,
        'neq'       => 1,

        'lessThan' => 2,
        'lt'       => 2,

        'lessOrEqualThan' => 3,
        'lte'             => 3,

        'moreThan' => 4,
        'gt'       => 4,

        'moreOrEqualThan' => 5,
        'gte'             => 5,

        'valueIn' => 6,
        'in'      => 6,

        'valueNotIn' => 7,
        'notIn'      => 7,

        'inValue' => 8,

        'notInValue' => 9,

        'startsWithValue' => 10,
        'startsWith'      => 10,

        'startsWithCaseInsensitiveValue' => 11,
        'startsWithCI'                   => 11,

        'notStartsWithValue' => 12,
        'notStartsWith'      => 12,

        'notStartsWithCaseInsensitiveValue' => 13,
        'notStartsWithCI'                   => 13,

        'valueStartsWith' => 14,
        'valueStartsWithCaseInsensitive' => 15,
        'valueNotStartsWith' => 16,
        'valueNotStartsWithCaseInsensitive' => 17
    );

    /**
     * Creates new search for a domain object
     * @param string $class Existing domain object class name
     * @throws  \InvalidArgumentException If class does not exsit
     */
    public function __construct($class)
    {
        if (!(class_exists($class))) {
            throw new \InvalidArgumentException('Domain object "'.$class.'" doesnot exist');
        }
        $this->domainObject = $class;
    }



    public function __call($filter, $params)
    {
        if (count($params)<2) {
            throw new \InvalidArgumentException('No value defined for filter '.$filter.'');
        }
        if (!isset($params[0])) {
            throw new \InvalidArgumentException('No property defined for filter '.$filter.'');
        }
        return $this->filter($filter, $params[0], $params[1]);
    }

    /**
     * Gets array of filters.
     * <code>
     * array('property' => array('Key'=>'int', 'Value'=>'mixed'))
     * </code>
     * @return array|null Filters array or null if no filters defined
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * Gets searched domain object class
     *
     * @return string Domain object class
     */
    public function getObject()
    {
        return $this->domainObject;
    }

    /**
     * Performs search
     *
     * @return array
     */
    public function search()
    {
        return
            DomainProxy::instance()->searchGeneric(
                $this->domainObject,
                $this->filters,
                $this->limit,
                $this->offset,
                $this->order);
    }

    public function count()
    {
        return
            DomainProxy::instance()->countGeneric(
                $this->domainObject,
                $this->filters);
    }

    private function filter($type, $property, $value)
    {
        if(!isset(self::$filterMap[$type])) {
            throw new \InvalidArgumentException('Undefined filter "'.$type.'"');
        }
        if (!property_exists($this->domainObject, $property)) {
            throw new \InvalidArgumentException('Cannot filter search on "'.$this->domainObject.'"" with non-existing property "'.$property.'"');
        }

        $filterId = self::$filterMap[$type];
        if (!isset($this->filters[$property])) {
            $this->filters[$property] = array();
        }
        $this->filters[$property][] = array(
            'Key'   => $filterId,
            'Value' => json_encode($value)
        );
        return $this;
    }
}
