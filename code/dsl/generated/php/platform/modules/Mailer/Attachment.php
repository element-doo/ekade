<?php
namespace Mailer;

require_once __DIR__.'/AttachmentJsonConverter.php';
require_once __DIR__.'/AttachmentArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property string $fileName a string
 * @property string $mimeType a string
 * @property \NGS\ByteStream $bytes a byte stream
 *
 * @package Mailer
 * @version 0.9.9 beta
 */
class Attachment implements \IteratorAggregate
{
    protected $fileName;
    protected $mimeType;
    protected $bytes;

    /**
     * Constructs object using a key-property array or instance of class "Mailer\Attachment"
     *
     * @param array|void $data key-property array or instance of class "Mailer\Attachment" or pass void to provide all fields with defaults
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
        if(!array_key_exists('fileName', $data))
            $data['fileName'] = ''; // a string
        if(!array_key_exists('mimeType', $data))
            $data['mimeType'] = ''; // a string
        if(!array_key_exists('bytes', $data))
            $data['bytes'] = new \NGS\ByteStream(); // a byte stream
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (array_key_exists('fileName', $data))
            $this->setFileName($data['fileName']);
        unset($data['fileName']);
        if (array_key_exists('mimeType', $data))
            $this->setMimeType($data['mimeType']);
        unset($data['mimeType']);
        if (array_key_exists('bytes', $data))
            $this->setBytes($data['bytes']);
        unset($data['bytes']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "Mailer\Attachment" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return a string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @return a string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @return a byte stream
     */
    public function getBytes()
    {
        return $this->bytes;
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
        if ($name === 'fileName')
            return $this->getFileName(); // a string
        if ($name === 'mimeType')
            return $this->getMimeType(); // a string
        if ($name === 'bytes')
            return $this->getBytes(); // a byte stream

        throw new \InvalidArgumentException('Property "'.$name.'" in class "Mailer\Attachment" does not exist and could not be retrieved!');
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
        if ($name === 'fileName')
            return true; // a string (always set)
        if ($name === 'mimeType')
            return true; // a string (always set)
        if ($name === 'bytes')
            return true; // a byte stream (always set)

        return false;
    }

    /**
     * @param string $value a string
     *
     * @return string
     */
    public function setFileName($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "fileName" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toString($value);
        $this->fileName = $value;
        return $value;
    }

    /**
     * @param string $value a string
     *
     * @return string
     */
    public function setMimeType($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "mimeType" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toString($value);
        $this->mimeType = $value;
        return $value;
    }

    /**
     * @param \NGS\ByteStream $value a byte stream
     *
     * @return \NGS\ByteStream
     */
    public function setBytes($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "bytes" cannot be set to null because it is non-nullable!');
        $value = \NGS\ByteStream::fromBase64($value);
        $this->bytes = $value;
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
        if ($name === 'fileName')
            return $this->setFileName($value); // a string
        if ($name === 'mimeType')
            return $this->setMimeType($value); // a string
        if ($name === 'bytes')
            return $this->setBytes($value); // a byte stream
        throw new \InvalidArgumentException('Property "'.$name.'" in class "Mailer\Attachment" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'fileName')
            throw new \LogicException('The property "fileName" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
        if ($name === 'mimeType')
            throw new \LogicException('The property "mimeType" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
        if ($name === 'bytes')
            throw new \LogicException('The property "bytes" cannot be unset because it is non-nullable!'); // a byte stream (cannot be unset)
    }

    public function toJson()
    {
        return \Mailer\AttachmentJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \Mailer\AttachmentJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'Mailer\Attachment'.$this->toJson();
    }

    public function __clone()
    {
        return \Mailer\AttachmentArrayConverter::fromArray(\Mailer\AttachmentArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \Mailer\AttachmentArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\Mailer\AttachmentArrayConverter::toArray($this));
    }
}