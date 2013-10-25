<?php
namespace ImageProvjera;

require_once __DIR__.'/OdgovorJsonConverter.php';
require_once __DIR__.'/OdgovorArrayConverter.php';
require_once __DIR__.'/DimenzijeSlike.php';

/**
 * Generated from NGS DSL
 *
 * @property bool $status a boolean value
 * @property string $poruka a string
 * @property \ImageProvjera\DimenzijeSlike $dimenzijeSlike an object of class "ImageProvjera\DimenzijeSlike", can be null
 *
 * @package ImageProvjera
 * @version 0.9.9 beta
 */
class Odgovor implements \IteratorAggregate
{
    protected $status;
    protected $poruka;
    protected $dimenzijeSlike;

    /**
     * Constructs object using a key-property array or instance of class "ImageProvjera\Odgovor"
     *
     * @param array|void $data key-property array or instance of class "ImageProvjera\Odgovor" or pass void to provide all fields with defaults
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
        if(!array_key_exists('status', $data))
            $data['status'] = false; // a boolean value
        if(!array_key_exists('poruka', $data))
            $data['poruka'] = ''; // a string
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (array_key_exists('status', $data))
            $this->setStatus($data['status']);
        unset($data['status']);
        if (array_key_exists('poruka', $data))
            $this->setPoruka($data['poruka']);
        unset($data['poruka']);
        if (array_key_exists('dimenzijeSlike', $data))
            $this->setDimenzijeSlike($data['dimenzijeSlike']);
        unset($data['dimenzijeSlike']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "ImageProvjera\Odgovor" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return a boolean value
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return a string
     */
    public function getPoruka()
    {
        return $this->poruka;
    }

    /**
     * @return an object of class "ImageProvjera\DimenzijeSlike", can be null
     */
    public function getDimenzijeSlike()
    {
        return $this->dimenzijeSlike;
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
        if ($name === 'status')
            return $this->getStatus(); // a boolean value
        if ($name === 'poruka')
            return $this->getPoruka(); // a string
        if ($name === 'dimenzijeSlike')
            return $this->getDimenzijeSlike(); // an object of class "ImageProvjera\DimenzijeSlike", can be null

        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageProvjera\Odgovor" does not exist and could not be retrieved!');
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
        if ($name === 'status')
            return true; // a boolean value (always set)
        if ($name === 'poruka')
            return true; // a string (always set)
        if ($name === 'dimenzijeSlike')
            return $this->getDimenzijeSlike() !== null; // an object of class "ImageProvjera\DimenzijeSlike", can be null

        return false;
    }

    /**
     * @param bool $value a boolean value
     *
     * @return bool
     */
    public function setStatus($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "status" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toBoolean($value);
        $this->status = $value;
        return $value;
    }

    /**
     * @param string $value a string
     *
     * @return string
     */
    public function setPoruka($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "poruka" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toString($value);
        $this->poruka = $value;
        return $value;
    }

    /**
     * @param \ImageProvjera\DimenzijeSlike $value an object of class "ImageProvjera\DimenzijeSlike", can be null
     *
     * @return \ImageProvjera\DimenzijeSlike
     */
    public function setDimenzijeSlike($value)
    {
        $value = $value !== null ? \ImageProvjera\DimenzijeSlikeArrayConverter::fromArray($value) : null;
        $this->dimenzijeSlike = $value;
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
        if ($name === 'status')
            return $this->setStatus($value); // a boolean value
        if ($name === 'poruka')
            return $this->setPoruka($value); // a string
        if ($name === 'dimenzijeSlike')
            return $this->setDimenzijeSlike($value); // an object of class "ImageProvjera\DimenzijeSlike", can be null
        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageProvjera\Odgovor" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'status')
            throw new \LogicException('The property "status" cannot be unset because it is non-nullable!'); // a boolean value (cannot be unset)
        if ($name === 'poruka')
            throw new \LogicException('The property "poruka" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
        if ($name === 'dimenzijeSlike')
            $this->setDimenzijeSlike(null);; // an object of class "ImageProvjera\DimenzijeSlike", can be null
    }

    public function toJson()
    {
        return \ImageProvjera\OdgovorJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \ImageProvjera\OdgovorJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'ImageProvjera\Odgovor'.$this->toJson();
    }

    public function __clone()
    {
        return \ImageProvjera\OdgovorArrayConverter::fromArray(\ImageProvjera\OdgovorArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \ImageProvjera\OdgovorArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\ImageProvjera\OdgovorArrayConverter::toArray($this));
    }
}
