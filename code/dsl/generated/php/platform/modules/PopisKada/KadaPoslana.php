<?php
namespace PopisKada;

require_once __DIR__.'/KadaPoslanaJsonConverter.php';
require_once __DIR__.'/KadaPoslanaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property string $URI a unique object identifier (read-only)
 * @property \NGS\UUID $kadaID a uuid
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
class KadaPoslana extends \NGS\Patterns\DomainEvent
{
    protected $URI;
    protected $kadaID;

    /**
     * Constructs object using a key-property array or instance of class "PopisKada\KadaPoslana"
     *
     * @param array|void $data key-property array or instance of class "PopisKada\KadaPoslana" or pass void to provide all fields with defaults
     */
    public function __construct($data = array())
    {
        if (is_array($data)) {
            $this->fromArray($data);
        } else {
            throw new \InvalidArgumentException('Constructor parameter must be an array! Type was: '.\NGS\Utils::getType($data));
        }
    }

    /**
     * Supply default values for uninitialized properties
     *
     * @param array $data key-property array which will be filled in-place
     */
    private static function provideDefaults(array &$data)
    {
        if(!array_key_exists('URI', $data))
            $data['URI'] = null; //a string representing a unique object identifier
        if(!array_key_exists('kadaID', $data))
            $data['kadaID'] = new \NGS\UUID(); // a uuid
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if(isset($data['URI']))
            $this->URI = \NGS\Converter\PrimitiveConverter::toString($data['URI']);
        unset($data['URI']);
        if (array_key_exists('kadaID', $data))
            $this->setKadaID($data['kadaID']);
        unset($data['kadaID']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "PopisKada\KadaPoslana" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * Helper getter function, body for magic method $this->__get('URI')
     * URI is a string representation of the primary key.
     *
     * @return string unique resource identifier representing this object
     */
    public function getURI()
    {
        return $this->URI;
    }

    /**
     * @return a uuid
     */
    public function getKadaID()
    {
        return $this->kadaID;
    }

    /**
     * Property getter which throws Exceptions on invalid access
     *
     * @param string $name Property name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if ($name === 'URI')
            return $this->getURI(); // a string representing a unique object identifier
        if ($name === 'kadaID')
            return $this->getKadaID(); // a uuid

        throw new \InvalidArgumentException('Property "'.$name.'" in class "PopisKada\KadaPoslana" does not exist and could not be retrieved!');
    }

// ============================================================================

    /**
     * Property existence checker
     *
     * @param string $name Property name to check for existence
     *
     * @return bool will return true if and only if the propery exist and is not null
     */
    public function __isset($name)
    {
        if ($name === 'URI')
            return $this->URI !== null;
        if ($name === 'kadaID')
            return true; // a uuid (always set)

        return false;
    }

    /**
     * @param \NGS\UUID $value a uuid
     *
     * @return \NGS\UUID
     */
    public function setKadaID($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "kadaID" cannot be set to null because it is non-nullable!');
        $value = new \NGS\UUID($value);
        $this->kadaID = $value;
        return $value;
    }

    /**
     * Property setter which checks for invalid access to domain event properties and enforces proper type checks
     *
     * @param string $name Property name
     * @param mixed $value Property value
     */
    public function __set($name, $value)
    {
        if ($name === 'URI')
            throw new \LogicException('Property "URI" in "PopisKada\KadaPoslana" cannot be set, because event URI is populated by server!');
        if ($name === 'kadaID')
            return $this->setKadaID($value); // a uuid
        throw new \InvalidArgumentException('Property "'.$name.'" in class "PopisKada\KadaPoslana" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'URI')
            throw new \LogicException('The property "URI" cannot be unset because event URI is created by server!');
        if ($name === 'kadaID')
            throw new \LogicException('The property "kadaID" cannot be unset because it is non-nullable!'); // a uuid (cannot be unset)
    }

    public function toJson()
    {
        return \PopisKada\KadaPoslanaJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \PopisKada\KadaPoslanaJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'PopisKada\KadaPoslana'.$this->toJson();
    }

    public function __clone()
    {
        return \PopisKada\KadaPoslanaArrayConverter::fromArray(\PopisKada\KadaPoslanaArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \PopisKada\KadaPoslanaArrayConverter::toArray($this);
    }
}