<?php
namespace NGS;

require_once(__DIR__.'/Utils.php');

use NGS\Utils;

/**
 * Used to represent bytestream objects
 * Since strings in php are equivalent to bytestreams (1 character=1 byte),this
 * functions as a simple wrapper around primitive php string with added sanity
 * checks and helpers
 *
 * @property string $value Returns raw bytestream value as string
 */
class ByteStream
{
    protected $value;

    /**
     * Creates a new instance from native string or stream resource
     *
     * @param string|\NGS\ByteStream|resource $value Primitive string, instance of ByteStream or a stream resource
     * @throws InvalidArgumentException If argument is not a valid type
     */
    public function __construct($value='')
    {
        if (is_string($value)) {
            $this->value = $value;
        } elseif ($value instanceof \NGS\ByteStream) {
            $this->value = $value->value;
        } elseif (is_resource($value) && get_resource_type($value)==='stream') {
            $this->value = stream_get_contents($value);
        } else {
            throw new \InvalidArgumentException('ByteStream could not be constructed from type "'.Utils::getType($value).'"');
        }
    }

    /**
     * Factory method accepts base64 encoded string or other ByteStream instance
     *
     * @return \NGS\ByteStream
     */
    public static function fromBase64($value)
    {
        if ($value instanceof ByteStream) {
            return new ByteStream($value);
        } else {
            if (!is_string($value)) {
                throw new \InvalidArgumentException('Value was not a string, invalid type was "'.\NGS\Utils::getType($value).'"');
            }
            $raw = base64_decode($value);
            // php has no easier way to check if string is valid base64
            if (base64_encode($raw) !== $value) {
                throw new \InvalidArgumentException('Value was not a valid base64 encoded string');
            }
            return new ByteStream($raw);
        }
    }

    /**
     * Factory method accepts raw string or other ByteStream instance
     *
     * @return \NGS\ByteStream
     */
    public static function fromBinary($value)
    {
        if ($value instanceof ByteStream) {
            return new ByteStream($value);
        } else {
            if (!is_string($value)) {
                throw new \InvalidArgumentException('Value was not a string, invalid type was "'.\NGS\Utils::getType($value).'"');
            }
            return new ByteStream($value);
        }
    }

    /**
     * Converts all elements in array to \NGS\Bytestream instances
     * String elements must be base64 encoded
     *
     * @param array $items Source array, each element must be a valid argument for Bytestream constructor
     * @param bool  $allowNullValues
     * @return array Resulting Bytestream array
     * @throws \InvalidArgumentException If any element is null or invalid type
     */
    public static function toArray(array $items, $allowNullValues=false)
    {
        $results = array();
        try {
            foreach ($items as $key => $val) {
                if ($allowNullValues && $val===null) {
                    $results[] = null;
                } elseif ($val === null) {
                    throw new \InvalidArgumentException('Null value found in provided array');
                } elseif (is_string($val)) {
                    $results[] = self::fromBase64($val);
                } elseif (!$val instanceof \NGS\ByteStream) {
                    $results[] = new \NGS\ByteStream($val);
                } else {
                    $results[] = $val;
                }
            }
        }
        catch(\Exception $e) {
            throw new \InvalidArgumentException('Element at index '.$key.' could not be converted to ByteStream!', 42, $e);
        }
        return $results;
    }

    /**
     * Magic getter for value property
     */
    public function __get($name)
    {
        if($name==='value') {
            return $this->value;
        }
        else {
            throw new \InvalidArgumentException('ByteStream: Cannot get undefined property "'.$name.'"');
        }
    }

    /**
     * Gets bytestream value encoded in base64
     *
     * @return string Base64 encoded bytestream
     */
    public function __toString()
    {
        return $this->toBase64();
    }

    /**
     * Gets bytestream value encoded in base64
     *
     * @return string Base64 encoded bytestream
     */
    public function toBase64()
    {
        return \base64_encode($this->value);
    }

    /**
     * Checks for equality against another ByteStream instance
     *
     * @param Bytestream $other Instance to compare with
     * @return bool
     */
    public function equals(\NGS\ByteStream $other)
    {
        return $this->value === $other->value;
    }

    /**
     * Gets bytestream size (number of bytes)
     *
     * @return int Bytestream size
     */
    public function size()
    {
        return strlen($this->value);
    }

    /**
     * Gets raw value
     *
     * @return string Bytestream value
     */
    public function getValue()
    {
        return $this->value;
    }
}
