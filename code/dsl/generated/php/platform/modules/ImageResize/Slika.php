<?php
namespace ImageResize;

require_once __DIR__.'/SlikaJsonConverter.php';
require_once __DIR__.'/SlikaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property \NGS\ByteStream $body a byte stream
 *
 * @package ImageResize
 * @version 0.9.9 beta
 */
class Slika implements \IteratorAggregate
{
    protected $body;

    /**
     * Constructs object using a key-property array or instance of class "ImageResize\Slika"
     *
     * @param array|void $data key-property array or instance of class "ImageResize\Slika" or pass void to provide all fields with defaults
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
        if(!array_key_exists('body', $data))
            $data['body'] = new \NGS\ByteStream(); // a byte stream
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (array_key_exists('body', $data))
            $this->setBody($data['body']);
        unset($data['body']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "ImageResize\Slika" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return a byte stream
     */
    public function getBody()
    {
        return $this->body;
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
        if ($name === 'body')
            return $this->getBody(); // a byte stream

        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageResize\Slika" does not exist and could not be retrieved!');
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
        if ($name === 'body')
            return true; // a byte stream (always set)

        return false;
    }

    /**
     * @param \NGS\ByteStream $value a byte stream
     *
     * @return \NGS\ByteStream
     */
    public function setBody($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "body" cannot be set to null because it is non-nullable!');
        $value = \NGS\ByteStream::fromBase64($value);
        $this->body = $value;
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
        if ($name === 'body')
            return $this->setBody($value); // a byte stream
        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageResize\Slika" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'body')
            throw new \LogicException('The property "body" cannot be unset because it is non-nullable!'); // a byte stream (cannot be unset)
    }

    public function toJson()
    {
        return \ImageResize\SlikaJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \ImageResize\SlikaJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'ImageResize\Slika'.$this->toJson();
    }

    public function __clone()
    {
        return \ImageResize\SlikaArrayConverter::fromArray(\ImageResize\SlikaArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \ImageResize\SlikaArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\ImageResize\SlikaArrayConverter::toArray($this));
    }
}