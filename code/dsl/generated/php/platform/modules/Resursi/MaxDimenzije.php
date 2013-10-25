<?php
namespace Resursi;

require_once __DIR__.'/MaxDimenzijeJsonConverter.php';
require_once __DIR__.'/MaxDimenzijeArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property string $URI a unique object identifier (read-only)
 * @property string $ID a string
 * @property int $width an integer number
 * @property int $height an integer number
 *
 * @package Resursi
 * @version 0.9.9 beta
 */
class MaxDimenzije extends \NGS\Patterns\AggregateRoot implements \IteratorAggregate
{
    protected $URI;
    protected $ID;
    protected $width;
    protected $height;

    /**
     * Constructs object using a key-property array or instance of class "Resursi\MaxDimenzije"
     *
     * @param array|void $data key-property array or instance of class "Resursi\MaxDimenzije" or pass void to provide all fields with defaults
     */
    public function __construct($data = array(), $construction_type = '')
    {
        if(is_array($data) && $construction_type !== 'build_internal') {
            foreach($data as $key => $val) {
                if(in_array($key, self::$_read_only_properties, true))
                    throw new \LogicException($key.' is a read only property and can\'t be set through the constructor.');
            }
        }
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
        if(!array_key_exists('ID', $data))
            $data['ID'] = ''; // a string
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

        if(isset($data['URI']))
            $this->URI = \NGS\Converter\PrimitiveConverter::toString($data['URI']);
        unset($data['URI']);
        if (array_key_exists('ID', $data))
            $this->setID($data['ID']);
        unset($data['ID']);
        if (array_key_exists('width', $data))
            $this->setWidth($data['width']);
        unset($data['width']);
        if (array_key_exists('height', $data))
            $this->setHeight($data['height']);
        unset($data['height']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "Resursi\MaxDimenzije" constructor: '.implode(', ', array_keys($data)));
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
     * @return a string
     */
    public function getID()
    {
        return $this->ID;
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
        if ($name === 'ID')
            return $this->getID(); // a string
        if ($name === 'width')
            return $this->getWidth(); // an integer number
        if ($name === 'height')
            return $this->getHeight(); // an integer number

        throw new \InvalidArgumentException('Property "'.$name.'" in class "Resursi\MaxDimenzije" does not exist and could not be retrieved!');
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
        if ($name === 'ID')
            return true; // a string (always set)
        if ($name === 'width')
            return true; // an integer number (always set)
        if ($name === 'height')
            return true; // an integer number (always set)

        return false;
    }

    private static $_read_only_properties = array('URI');

    /**
     * @param string $value a string
     *
     * @return string
     */
    public function setID($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "ID" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toString($value);
        $this->ID = $value;
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
     * Property setter which checks for invalid access to entity properties and enforces proper type checks
     *
     * @param string $name Property name
     * @param mixed $value Property value
     */
    public function __set($name, $value)
    {
        if(in_array($name, self::$_read_only_properties, true))
            throw new \LogicException('Property "'.$name.'" in "Resursi\MaxDimenzije" cannot be set, because it is read-only!');
        if ($name === 'ID')
            return $this->setID($value); // a string
        if ($name === 'width')
            return $this->setWidth($value); // an integer number
        if ($name === 'height')
            return $this->setHeight($value); // an integer number
        throw new \InvalidArgumentException('Property "'.$name.'" in class "Resursi\MaxDimenzije" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if(in_array($name, self::$_read_only_properties, true))
            throw new \LogicException('Property "'.$name.'" cannot be unset, because it is read-only!');
        if ($name === 'ID')
            throw new \LogicException('The property "ID" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
        if ($name === 'width')
            throw new \LogicException('The property "width" cannot be unset because it is non-nullable!'); // an integer number (cannot be unset)
        if ($name === 'height')
            throw new \LogicException('The property "height" cannot be unset because it is non-nullable!'); // an integer number (cannot be unset)
    }

    /**
     * Create or update Resursi\MaxDimenzije instance (server call)
     *
     * @return modified instance object
     */
    public function persist()
    {

        $newObject = parent::persist();
        $this->updateWithAnother($newObject);

        return $this;
    }

    private function updateWithAnother(\Resursi\MaxDimenzije $result)
    {
        $this->URI = $result->URI;

        $this->ID = $result->ID;
        $this->width = $result->width;
        $this->height = $result->height;
    }

    public function toJson()
    {
        return \Resursi\MaxDimenzijeJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \Resursi\MaxDimenzijeJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'Resursi\MaxDimenzije'.$this->toJson();
    }

    public function __clone()
    {
        return \Resursi\MaxDimenzijeArrayConverter::fromArray(\Resursi\MaxDimenzijeArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \Resursi\MaxDimenzijeArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\Resursi\MaxDimenzijeArrayConverter::toArray($this));
    }
}
