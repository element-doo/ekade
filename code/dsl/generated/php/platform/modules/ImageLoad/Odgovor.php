<?php
namespace ImageLoad;

require_once __DIR__.'/OdgovorJsonConverter.php';
require_once __DIR__.'/OdgovorArrayConverter.php';
require_once __DIR__.'/../Resursi/PodaciSlike.php';

/**
 * Generated from NGS DSL
 *
 * @property \Resursi\PodaciSlike $podaciSlike an object of class "Resursi\PodaciSlike"
 * @property \NGS\ByteStream $body a byte stream
 *
 * @package ImageLoad
 * @version 0.9.9 beta
 */
class Odgovor implements \IteratorAggregate
{
    protected $podaciSlike;
    protected $body;

    /**
     * Constructs object using a key-property array or instance of class "ImageLoad\Odgovor"
     *
     * @param array|void $data key-property array or instance of class "ImageLoad\Odgovor" or pass void to provide all fields with defaults
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
        if(!array_key_exists('podaciSlike', $data))
            $data['podaciSlike'] = new \Resursi\PodaciSlike(); // an object of class "Resursi\PodaciSlike"
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

        if (array_key_exists('podaciSlike', $data))
            $this->setPodaciSlike($data['podaciSlike']);
        unset($data['podaciSlike']);
        if (array_key_exists('body', $data))
            $this->setBody($data['body']);
        unset($data['body']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "ImageLoad\Odgovor" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return an object of class "Resursi\PodaciSlike"
     */
    public function getPodaciSlike()
    {
        return $this->podaciSlike;
    }

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
        if ($name === 'podaciSlike')
            return $this->getPodaciSlike(); // an object of class "Resursi\PodaciSlike"
        if ($name === 'body')
            return $this->getBody(); // a byte stream

        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageLoad\Odgovor" does not exist and could not be retrieved!');
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
        if ($name === 'podaciSlike')
            return true; // an object of class "Resursi\PodaciSlike" (always set)
        if ($name === 'body')
            return true; // a byte stream (always set)

        return false;
    }

    /**
     * @param \Resursi\PodaciSlike $value an object of class "Resursi\PodaciSlike"
     *
     * @return \Resursi\PodaciSlike
     */
    public function setPodaciSlike($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "podaciSlike" cannot be set to null because it is non-nullable!');
        $value = \Resursi\PodaciSlikeArrayConverter::fromArray($value);
        $this->podaciSlike = $value;
        return $value;
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
        if ($name === 'podaciSlike')
            return $this->setPodaciSlike($value); // an object of class "Resursi\PodaciSlike"
        if ($name === 'body')
            return $this->setBody($value); // a byte stream
        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageLoad\Odgovor" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'podaciSlike')
            throw new \LogicException('The property "podaciSlike" cannot be unset because it is non-nullable!'); // an object of class "Resursi\PodaciSlike" (cannot be unset)
        if ($name === 'body')
            throw new \LogicException('The property "body" cannot be unset because it is non-nullable!'); // a byte stream (cannot be unset)
    }

    public function toJson()
    {
        return \ImageLoad\OdgovorJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \ImageLoad\OdgovorJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'ImageLoad\Odgovor'.$this->toJson();
    }

    public function __clone()
    {
        return \ImageLoad\OdgovorArrayConverter::fromArray(\ImageLoad\OdgovorArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \ImageLoad\OdgovorArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\ImageLoad\OdgovorArrayConverter::toArray($this));
    }
}