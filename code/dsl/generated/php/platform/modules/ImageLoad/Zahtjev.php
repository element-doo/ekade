<?php
namespace ImageLoad;

require_once __DIR__.'/ZahtjevJsonConverter.php';
require_once __DIR__.'/ZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property \NGS\UUID $kadaID a uuid
 * @property string $tipSlike a string
 *
 * @package ImageLoad
 * @version 0.9.9 beta
 */
class Zahtjev implements \IteratorAggregate
{
    protected $kadaID;
    protected $tipSlike;

    /**
     * Constructs object using a key-property array or instance of class "ImageLoad\Zahtjev"
     *
     * @param array|void $data key-property array or instance of class "ImageLoad\Zahtjev" or pass void to provide all fields with defaults
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
        if(!array_key_exists('kadaID', $data))
            $data['kadaID'] = new \NGS\UUID(); // a uuid
        if(!array_key_exists('tipSlike', $data))
            $data['tipSlike'] = ''; // a string
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (array_key_exists('kadaID', $data))
            $this->setKadaID($data['kadaID']);
        unset($data['kadaID']);
        if (array_key_exists('tipSlike', $data))
            $this->setTipSlike($data['tipSlike']);
        unset($data['tipSlike']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "ImageLoad\Zahtjev" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return a uuid
     */
    public function getKadaID()
    {
        return $this->kadaID;
    }

    /**
     * @return a string
     */
    public function getTipSlike()
    {
        return $this->tipSlike;
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
        if ($name === 'kadaID')
            return $this->getKadaID(); // a uuid
        if ($name === 'tipSlike')
            return $this->getTipSlike(); // a string

        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageLoad\Zahtjev" does not exist and could not be retrieved!');
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
        if ($name === 'kadaID')
            return true; // a uuid (always set)
        if ($name === 'tipSlike')
            return true; // a string (always set)

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
     * @param string $value a string
     *
     * @return string
     */
    public function setTipSlike($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "tipSlike" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toString($value);
        $this->tipSlike = $value;
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
        if ($name === 'kadaID')
            return $this->setKadaID($value); // a uuid
        if ($name === 'tipSlike')
            return $this->setTipSlike($value); // a string
        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageLoad\Zahtjev" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'kadaID')
            throw new \LogicException('The property "kadaID" cannot be unset because it is non-nullable!'); // a uuid (cannot be unset)
        if ($name === 'tipSlike')
            throw new \LogicException('The property "tipSlike" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
    }

    public function toJson()
    {
        return \ImageLoad\ZahtjevJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \ImageLoad\ZahtjevJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'ImageLoad\Zahtjev'.$this->toJson();
    }

    public function __clone()
    {
        return \ImageLoad\ZahtjevArrayConverter::fromArray(\ImageLoad\ZahtjevArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \ImageLoad\ZahtjevArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\ImageLoad\ZahtjevArrayConverter::toArray($this));
    }
}