<?php
namespace ImageProvjera;

require_once __DIR__.'/DimenzijeSlikeJsonConverter.php';
require_once __DIR__.'/DimenzijeSlikeArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property int $width an integer number
 * @property int $height an integer number
 *
 * @package ImageProvjera
 * @version 0.9.9 beta
 */
class DimenzijeSlike implements \IteratorAggregate
{
    protected $width;
    protected $height;

    /**
     * Constructs object using a key-property array or instance of class "ImageProvjera\DimenzijeSlike"
     *
     * @param array|void $data key-property array or instance of class "ImageProvjera\DimenzijeSlike" or pass void to provide all fields with defaults
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
        if(!array_key_exists('width', $data))
            $data['width'] = 0; // an integer number
        if(!array_key_exists('height', $data))
            $data['height'] = 0; // an integer number
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (array_key_exists('width', $data))
            $this->setWidth($data['width']);
        unset($data['width']);
        if (array_key_exists('height', $data))
            $this->setHeight($data['height']);
        unset($data['height']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "ImageProvjera\DimenzijeSlike" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return an integer number
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return an integer number
     */
    public function getHeight()
    {
        return $this->height;
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
        if ($name === 'width')
            return $this->getWidth(); // an integer number
        if ($name === 'height')
            return $this->getHeight(); // an integer number

        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageProvjera\DimenzijeSlike" does not exist and could not be retrieved!');
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
        if ($name === 'width')
            return true; // an integer number (always set)
        if ($name === 'height')
            return true; // an integer number (always set)

        return false;
    }

    /**
     * @param int $value an integer number
     *
     * @return int
     */
    public function setWidth($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "width" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toInteger($value);
        $this->width = $value;
        return $value;
    }

    /**
     * @param int $value an integer number
     *
     * @return int
     */
    public function setHeight($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "height" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toInteger($value);
        $this->height = $value;
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
        if ($name === 'width')
            return $this->setWidth($value); // an integer number
        if ($name === 'height')
            return $this->setHeight($value); // an integer number
        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageProvjera\DimenzijeSlike" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'width')
            throw new \LogicException('The property "width" cannot be unset because it is non-nullable!'); // an integer number (cannot be unset)
        if ($name === 'height')
            throw new \LogicException('The property "height" cannot be unset because it is non-nullable!'); // an integer number (cannot be unset)
    }

    public function toJson()
    {
        return \ImageProvjera\DimenzijeSlikeJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \ImageProvjera\DimenzijeSlikeJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'ImageProvjera\DimenzijeSlike'.$this->toJson();
    }

    public function __clone()
    {
        return \ImageProvjera\DimenzijeSlikeArrayConverter::fromArray(\ImageProvjera\DimenzijeSlikeArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \ImageProvjera\DimenzijeSlikeArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\ImageProvjera\DimenzijeSlikeArrayConverter::toArray($this));
    }
}