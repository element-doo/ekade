<?php
namespace ImageSave;

require_once __DIR__.'/OdgovorJsonConverter.php';
require_once __DIR__.'/OdgovorArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 *
 * @package ImageSave
 * @version 0.9.9 beta
 */
class Odgovor implements \IteratorAggregate
{

    /**
     * Constructs object using a key-property array or instance of class "ImageSave\Odgovor"
     *
     * @param array|void $data key-property array or instance of class "ImageSave\Odgovor" or pass void to provide all fields with defaults
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
    private static function provideDefaults(array &$data) {}

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "ImageSave\Odgovor" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * Property getter which throws Exceptions on invalid access
     *
     * @param string $name Property name
     *
     * @return mixed
     */
    public function __get($name)
    {

        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageSave\Odgovor" does not exist and could not be retrieved!');
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

        return false;
    }

    /**
     * Property setter which checks for invalid access to value properties and enforces proper type checks
     *
     * @param string $name Property name
     * @param mixed $value Property value
     */
    public function __set($name, $value)
    {
        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageSave\Odgovor" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name) {}

    public function toJson()
    {
        return \ImageSave\OdgovorJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \ImageSave\OdgovorJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'ImageSave\Odgovor'.$this->toJson();
    }

    public function __clone()
    {
        return \ImageSave\OdgovorArrayConverter::fromArray(\ImageSave\OdgovorArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \ImageSave\OdgovorArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\ImageSave\OdgovorArrayConverter::toArray($this));
    }
}