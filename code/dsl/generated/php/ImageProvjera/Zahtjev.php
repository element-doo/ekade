<?php
namespace ImageProvjera;

require_once __DIR__.'/ZahtjevJsonConverter.php';
require_once __DIR__.'/ZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property int $velicinaSlike an integer number
 * @property \NGS\ByteStream $originalnaSlika a byte stream
 *
 * @package ImageProvjera
 * @version 0.9.9 beta
 */
class Zahtjev implements \IteratorAggregate
{
    protected $velicinaSlike;
    protected $originalnaSlika;

    /**
     * Constructs object using a key-property array or instance of class "ImageProvjera\Zahtjev"
     *
     * @param array|void $data key-property array or instance of class "ImageProvjera\Zahtjev" or pass void to provide all fields with defaults
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
        if(!array_key_exists('velicinaSlike', $data))
            $data['velicinaSlike'] = 0; // an integer number
        if(!array_key_exists('originalnaSlika', $data))
            $data['originalnaSlika'] = new \NGS\ByteStream(); // a byte stream
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (array_key_exists('velicinaSlike', $data))
            $this->setVelicinaSlike($data['velicinaSlike']);
        unset($data['velicinaSlike']);
        if (array_key_exists('originalnaSlika', $data))
            $this->setOriginalnaSlika($data['originalnaSlika']);
        unset($data['originalnaSlika']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "ImageProvjera\Zahtjev" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return an integer number
     */
    public function getVelicinaSlike()
    {
        return $this->velicinaSlike;
    }

    /**
     * @return a byte stream
     */
    public function getOriginalnaSlika()
    {
        return $this->originalnaSlika;
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
        if ($name === 'velicinaSlike')
            return $this->getVelicinaSlike(); // an integer number
        if ($name === 'originalnaSlika')
            return $this->getOriginalnaSlika(); // a byte stream

        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageProvjera\Zahtjev" does not exist and could not be retrieved!');
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
        if ($name === 'velicinaSlike')
            return true; // an integer number (always set)
        if ($name === 'originalnaSlika')
            return true; // a byte stream (always set)

        return false;
    }

    /**
     * @param int $value an integer number
     *
     * @return int
     */
    public function setVelicinaSlike($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "velicinaSlike" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toInteger($value);
        $this->velicinaSlike = $value;
        return $value;
    }

    /**
     * @param \NGS\ByteStream $value a byte stream
     *
     * @return \NGS\ByteStream
     */
    public function setOriginalnaSlika($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "originalnaSlika" cannot be set to null because it is non-nullable!');
        $value = \NGS\ByteStream::fromBase64($value);
        $this->originalnaSlika = $value;
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
        if ($name === 'velicinaSlike')
            return $this->setVelicinaSlike($value); // an integer number
        if ($name === 'originalnaSlika')
            return $this->setOriginalnaSlika($value); // a byte stream
        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageProvjera\Zahtjev" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'velicinaSlike')
            throw new \LogicException('The property "velicinaSlike" cannot be unset because it is non-nullable!'); // an integer number (cannot be unset)
        if ($name === 'originalnaSlika')
            throw new \LogicException('The property "originalnaSlika" cannot be unset because it is non-nullable!'); // a byte stream (cannot be unset)
    }

    public function toJson()
    {
        return \ImageProvjera\ZahtjevJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \ImageProvjera\ZahtjevJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'ImageProvjera\Zahtjev'.$this->toJson();
    }

    public function __clone()
    {
        return \ImageProvjera\ZahtjevArrayConverter::fromArray(\ImageProvjera\ZahtjevArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \ImageProvjera\ZahtjevArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\ImageProvjera\ZahtjevArrayConverter::toArray($this));
    }
}
