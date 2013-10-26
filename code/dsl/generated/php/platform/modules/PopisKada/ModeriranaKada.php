<?php
namespace PopisKada;

require_once __DIR__.'/ModeriranaKadaJsonConverter.php';
require_once __DIR__.'/ModeriranaKadaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property bool $odobrena a boolean value
 * @property \NGS\UUID $kadaID a uuid
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
class ModeriranaKada implements \IteratorAggregate
{
    protected $odobrena;
    protected $kadaID;

    /**
     * Constructs object using a key-property array or instance of class "PopisKada\ModeriranaKada"
     *
     * @param array|void $data key-property array or instance of class "PopisKada\ModeriranaKada" or pass void to provide all fields with defaults
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
        if(!array_key_exists('odobrena', $data))
            $data['odobrena'] = false; // a boolean value
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

        if (array_key_exists('odobrena', $data))
            $this->setOdobrena($data['odobrena']);
        unset($data['odobrena']);
        if (array_key_exists('kadaID', $data))
            $this->setKadaID($data['kadaID']);
        unset($data['kadaID']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "PopisKada\ModeriranaKada" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return a boolean value
     */
    public function getOdobrena()
    {
        return $this->odobrena;
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
        if ($name === 'odobrena')
            return $this->getOdobrena(); // a boolean value
        if ($name === 'kadaID')
            return $this->getKadaID(); // a uuid

        throw new \InvalidArgumentException('Property "'.$name.'" in class "PopisKada\ModeriranaKada" does not exist and could not be retrieved!');
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
        if ($name === 'odobrena')
            return true; // a boolean value (always set)
        if ($name === 'kadaID')
            return true; // a uuid (always set)

        return false;
    }

    /**
     * @param bool $value a boolean value
     *
     * @return bool
     */
    public function setOdobrena($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "odobrena" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toBoolean($value);
        $this->odobrena = $value;
        return $value;
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
     * Property setter which checks for invalid access to value properties and enforces proper type checks
     *
     * @param string $name Property name
     * @param mixed $value Property value
     */
    public function __set($name, $value)
    {
        if ($name === 'odobrena')
            return $this->setOdobrena($value); // a boolean value
        if ($name === 'kadaID')
            return $this->setKadaID($value); // a uuid
        throw new \InvalidArgumentException('Property "'.$name.'" in class "PopisKada\ModeriranaKada" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'odobrena')
            throw new \LogicException('The property "odobrena" cannot be unset because it is non-nullable!'); // a boolean value (cannot be unset)
        if ($name === 'kadaID')
            throw new \LogicException('The property "kadaID" cannot be unset because it is non-nullable!'); // a uuid (cannot be unset)
    }

    public function toJson()
    {
        return \PopisKada\ModeriranaKadaJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \PopisKada\ModeriranaKadaJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'PopisKada\ModeriranaKada'.$this->toJson();
    }

    public function __clone()
    {
        return \PopisKada\ModeriranaKadaArrayConverter::fromArray(\PopisKada\ModeriranaKadaArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \PopisKada\ModeriranaKadaArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\PopisKada\ModeriranaKadaArrayConverter::toArray($this));
    }
}