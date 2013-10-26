<?php
namespace ImageResize;

require_once __DIR__.'/ResizeZahtjevJsonConverter.php';
require_once __DIR__.'/ResizeZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property int $width an integer number
 * @property int $height an integer number
 * @property int $depth an integer number
 * @property string $format a string
 *
 * @package ImageResize
 * @version 0.9.9 beta
 */
class ResizeZahtjev implements \IteratorAggregate
{
    protected $width;
    protected $height;
    protected $depth;
    protected $format;

    /**
     * Constructs object using a key-property array or instance of class "ImageResize\ResizeZahtjev"
     *
     * @param array|void $data key-property array or instance of class "ImageResize\ResizeZahtjev" or pass void to provide all fields with defaults
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
        if(!array_key_exists('depth', $data))
            $data['depth'] = 0; // an integer number
        if(!array_key_exists('format', $data))
            $data['format'] = ''; // a string
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
        if (array_key_exists('depth', $data))
            $this->setDepth($data['depth']);
        unset($data['depth']);
        if (array_key_exists('format', $data))
            $this->setFormat($data['format']);
        unset($data['format']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "ImageResize\ResizeZahtjev" constructor: '.implode(', ', array_keys($data)));
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
     * @return an integer number
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @return a string
     */
    public function getFormat()
    {
        return $this->format;
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
        if ($name === 'depth')
            return $this->getDepth(); // an integer number
        if ($name === 'format')
            return $this->getFormat(); // a string

        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageResize\ResizeZahtjev" does not exist and could not be retrieved!');
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
        if ($name === 'depth')
            return true; // an integer number (always set)
        if ($name === 'format')
            return true; // a string (always set)

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
     * @param int $value an integer number
     *
     * @return int
     */
    public function setDepth($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "depth" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toInteger($value);
        $this->depth = $value;
        return $value;
    }

    /**
     * @param string $value a string
     *
     * @return string
     */
    public function setFormat($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "format" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toString($value);
        $this->format = $value;
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
        if ($name === 'depth')
            return $this->setDepth($value); // an integer number
        if ($name === 'format')
            return $this->setFormat($value); // a string
        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageResize\ResizeZahtjev" does not exist and could not be set!');
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
        if ($name === 'depth')
            throw new \LogicException('The property "depth" cannot be unset because it is non-nullable!'); // an integer number (cannot be unset)
        if ($name === 'format')
            throw new \LogicException('The property "format" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
    }

    public function toJson()
    {
        return \ImageResize\ResizeZahtjevJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \ImageResize\ResizeZahtjevJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'ImageResize\ResizeZahtjev'.$this->toJson();
    }

    public function __clone()
    {
        return \ImageResize\ResizeZahtjevArrayConverter::fromArray(\ImageResize\ResizeZahtjevArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \ImageResize\ResizeZahtjevArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\ImageResize\ResizeZahtjevArrayConverter::toArray($this));
    }
}