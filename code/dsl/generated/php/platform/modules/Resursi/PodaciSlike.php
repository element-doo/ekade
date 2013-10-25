<?php
namespace Resursi;

require_once __DIR__.'/PodaciSlikeJsonConverter.php';
require_once __DIR__.'/PodaciSlikeArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property string $ime a string
 * @property string $format a string
 * @property int $width an integer number
 * @property int $height an integer number
 * @property int $size an integer number
 * @property string $filename a string, calculated by server (read-only)
 *
 * @package Resursi
 * @version 0.9.9 beta
 */
class PodaciSlike implements \IteratorAggregate
{
    protected $ime;
    protected $format;
    protected $width;
    protected $height;
    protected $size;
    protected $filename;

    /**
     * Constructs object using a key-property array or instance of class "Resursi\PodaciSlike"
     *
     * @param array|void $data key-property array or instance of class "Resursi\PodaciSlike" or pass void to provide all fields with defaults
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
        if(!array_key_exists('ime', $data))
            $data['ime'] = ''; // a string
        if(!array_key_exists('format', $data))
            $data['format'] = ''; // a string
        if(!array_key_exists('width', $data))
            $data['width'] = 0; // an integer number
        if(!array_key_exists('height', $data))
            $data['height'] = 0; // an integer number
        if(!array_key_exists('size', $data))
            $data['size'] = 0; // an integer number
        if(!array_key_exists('filename', $data))
            $data['filename'] = ''; // a string, calculated by server
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (array_key_exists('ime', $data))
            $this->setIme($data['ime']);
        unset($data['ime']);
        if (array_key_exists('format', $data))
            $this->setFormat($data['format']);
        unset($data['format']);
        if (array_key_exists('width', $data))
            $this->setWidth($data['width']);
        unset($data['width']);
        if (array_key_exists('height', $data))
            $this->setHeight($data['height']);
        unset($data['height']);
        if (array_key_exists('size', $data))
            $this->setSize($data['size']);
        unset($data['size']);
        if (isset($data['filename']))
            $this->filename = \NGS\Converter\PrimitiveConverter::toString($data['filename']);
        unset($data['filename']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "Resursi\PodaciSlike" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return a string
     */
    public function getIme()
    {
        return $this->ime;
    }

    /**
     * @return a string
     */
    public function getFormat()
    {
        return $this->format;
    }

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
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return a string, calculated by server
     */
    public function getFilename()
    {
        return $this->filename;
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
        if ($name === 'ime')
            return $this->getIme(); // a string
        if ($name === 'format')
            return $this->getFormat(); // a string
        if ($name === 'width')
            return $this->getWidth(); // an integer number
        if ($name === 'height')
            return $this->getHeight(); // an integer number
        if ($name === 'size')
            return $this->getSize(); // an integer number
        if ($name === 'filename')
            return $this->getFilename(); // a string, calculated by server

        throw new \InvalidArgumentException('Property "'.$name.'" in class "Resursi\PodaciSlike" does not exist and could not be retrieved!');
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
        if ($name === 'ime')
            return true; // a string (always set)
        if ($name === 'format')
            return true; // a string (always set)
        if ($name === 'width')
            return true; // an integer number (always set)
        if ($name === 'height')
            return true; // an integer number (always set)
        if ($name === 'size')
            return true; // an integer number (always set)
        if ($name === 'filename')
            return true; // a string, calculated by server (always set)

        return false;
    }

    /**
     * @param string $value a string
     *
     * @return string
     */
    public function setIme($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "ime" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toString($value);
        $this->ime = $value;
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
    public function setSize($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "size" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toInteger($value);
        $this->size = $value;
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
        if ($name === 'ime')
            return $this->setIme($value); // a string
        if ($name === 'format')
            return $this->setFormat($value); // a string
        if ($name === 'width')
            return $this->setWidth($value); // an integer number
        if ($name === 'height')
            return $this->setHeight($value); // an integer number
        if ($name === 'size')
            return $this->setSize($value); // an integer number
        throw new \InvalidArgumentException('Property "'.$name.'" in class "Resursi\PodaciSlike" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'ime')
            throw new \LogicException('The property "ime" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
        if ($name === 'format')
            throw new \LogicException('The property "format" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
        if ($name === 'width')
            throw new \LogicException('The property "width" cannot be unset because it is non-nullable!'); // an integer number (cannot be unset)
        if ($name === 'height')
            throw new \LogicException('The property "height" cannot be unset because it is non-nullable!'); // an integer number (cannot be unset)
        if ($name === 'size')
            throw new \LogicException('The property "size" cannot be unset because it is non-nullable!'); // an integer number (cannot be unset)
    }

    public function toJson()
    {
        return \Resursi\PodaciSlikeJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \Resursi\PodaciSlikeJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'Resursi\PodaciSlike'.$this->toJson();
    }

    public function __clone()
    {
        return \Resursi\PodaciSlikeArrayConverter::fromArray(\Resursi\PodaciSlikeArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \Resursi\PodaciSlikeArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\Resursi\PodaciSlikeArrayConverter::toArray($this));
    }
}
