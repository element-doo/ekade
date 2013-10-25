<?php
namespace Resursi;

require_once __DIR__.'/FingerprintJsonConverter.php';
require_once __DIR__.'/FingerprintArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property \NGS\ByteStream $sha1Bytes a byte stream
 * @property \NGS\ByteStream $sha1Pixels a byte stream, can be null
 *
 * @package Resursi
 * @version 0.9.9 beta
 */
class Fingerprint implements \IteratorAggregate
{
    protected $sha1Bytes;
    protected $sha1Pixels;

    /**
     * Constructs object using a key-property array or instance of class "Resursi\Fingerprint"
     *
     * @param array|void $data key-property array or instance of class "Resursi\Fingerprint" or pass void to provide all fields with defaults
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
        if(!array_key_exists('sha1Bytes', $data))
            $data['sha1Bytes'] = new \NGS\ByteStream(); // a byte stream
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (array_key_exists('sha1Bytes', $data))
            $this->setSha1Bytes($data['sha1Bytes']);
        unset($data['sha1Bytes']);
        if (array_key_exists('sha1Pixels', $data))
            $this->setSha1Pixels($data['sha1Pixels']);
        unset($data['sha1Pixels']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "Resursi\Fingerprint" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return a byte stream
     */
    public function getSha1Bytes()
    {
        return $this->sha1Bytes;
    }

    /**
     * @return a byte stream, can be null
     */
    public function getSha1Pixels()
    {
        return $this->sha1Pixels;
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
        if ($name === 'sha1Bytes')
            return $this->getSha1Bytes(); // a byte stream
        if ($name === 'sha1Pixels')
            return $this->getSha1Pixels(); // a byte stream, can be null

        throw new \InvalidArgumentException('Property "'.$name.'" in class "Resursi\Fingerprint" does not exist and could not be retrieved!');
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
        if ($name === 'sha1Bytes')
            return true; // a byte stream (always set)
        if ($name === 'sha1Pixels')
            return $this->getSha1Pixels() !== null; // a byte stream, can be null

        return false;
    }

    /**
     * @param \NGS\ByteStream $value a byte stream
     *
     * @return \NGS\ByteStream
     */
    public function setSha1Bytes($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "sha1Bytes" cannot be set to null because it is non-nullable!');
        $value = \NGS\ByteStream::fromBase64($value);
        $this->sha1Bytes = $value;
        return $value;
    }

    /**
     * @param \NGS\ByteStream $value a byte stream, can be null
     *
     * @return \NGS\ByteStream
     */
    public function setSha1Pixels($value)
    {
        $value = $value !== null ? \NGS\ByteStream::fromBase64($value) : null;
        $this->sha1Pixels = $value;
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
        if ($name === 'sha1Bytes')
            return $this->setSha1Bytes($value); // a byte stream
        if ($name === 'sha1Pixels')
            return $this->setSha1Pixels($value); // a byte stream, can be null
        throw new \InvalidArgumentException('Property "'.$name.'" in class "Resursi\Fingerprint" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'sha1Bytes')
            throw new \LogicException('The property "sha1Bytes" cannot be unset because it is non-nullable!'); // a byte stream (cannot be unset)
        if ($name === 'sha1Pixels')
            $this->setSha1Pixels(null);; // a byte stream, can be null
    }

    public function toJson()
    {
        return \Resursi\FingerprintJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \Resursi\FingerprintJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'Resursi\Fingerprint'.$this->toJson();
    }

    public function __clone()
    {
        return \Resursi\FingerprintArrayConverter::fromArray(\Resursi\FingerprintArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \Resursi\FingerprintArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\Resursi\FingerprintArrayConverter::toArray($this));
    }
}