<?php
namespace ImageSave;

require_once __DIR__.'/ZahtjevJsonConverter.php';
require_once __DIR__.'/ZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property \NGS\UUID $kadaID a uuid
 * @property \NGS\ByteStream $thumbnail a byte stream
 * @property \NGS\ByteStream $original a byte stream
 * @property \NGS\ByteStream $email a byte stream
 * @property \NGS\ByteStream $web a byte stream
 *
 * @package ImageSave
 * @version 0.9.9 beta
 */
class Zahtjev implements \IteratorAggregate
{
    protected $kadaID;
    protected $thumbnail;
    protected $original;
    protected $email;
    protected $web;

    /**
     * Constructs object using a key-property array or instance of class "ImageSave\Zahtjev"
     *
     * @param array|void $data key-property array or instance of class "ImageSave\Zahtjev" or pass void to provide all fields with defaults
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
        if(!array_key_exists('kadaID', $data))
            $data['kadaID'] = new \NGS\UUID(); // a uuid
        if(!array_key_exists('thumbnail', $data))
            $data['thumbnail'] = new \NGS\ByteStream(); // a byte stream
        if(!array_key_exists('original', $data))
            $data['original'] = new \NGS\ByteStream(); // a byte stream
        if(!array_key_exists('email', $data))
            $data['email'] = new \NGS\ByteStream(); // a byte stream
        if(!array_key_exists('web', $data))
            $data['web'] = new \NGS\ByteStream(); // a byte stream
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (array_key_exists('kadaID', $data))
            $this->setKadaID($data['kadaID']);
        unset($data['kadaID']);
        if (array_key_exists('thumbnail', $data))
            $this->setThumbnail($data['thumbnail']);
        unset($data['thumbnail']);
        if (array_key_exists('original', $data))
            $this->setOriginal($data['original']);
        unset($data['original']);
        if (array_key_exists('email', $data))
            $this->setEmail($data['email']);
        unset($data['email']);
        if (array_key_exists('web', $data))
            $this->setWeb($data['web']);
        unset($data['web']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "ImageSave\Zahtjev" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return a uuid
     */
    public function getKadaID()
    {
        return $this->kadaID;
    }

    /**
     * @return a byte stream
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @return a byte stream
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * @return a byte stream
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return a byte stream
     */
    public function getWeb()
    {
        return $this->web;
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
        if ($name === 'kadaID')
            return $this->getKadaID(); // a uuid
        if ($name === 'thumbnail')
            return $this->getThumbnail(); // a byte stream
        if ($name === 'original')
            return $this->getOriginal(); // a byte stream
        if ($name === 'email')
            return $this->getEmail(); // a byte stream
        if ($name === 'web')
            return $this->getWeb(); // a byte stream

        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageSave\Zahtjev" does not exist and could not be retrieved!');
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
        if ($name === 'kadaID')
            return true; // a uuid (always set)
        if ($name === 'thumbnail')
            return true; // a byte stream (always set)
        if ($name === 'original')
            return true; // a byte stream (always set)
        if ($name === 'email')
            return true; // a byte stream (always set)
        if ($name === 'web')
            return true; // a byte stream (always set)

        return false;
    }

    /**
     * @param \NGS\UUID $value a uuid
     *
     * @return \NGS\UUID
     */
    public function setKadaID($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "kadaID" cannot be set to null because it is non-nullable!');
        $value = new \NGS\UUID($value);
        $this->kadaID = $value;
        return $value;
    }

    /**
     * @param \NGS\ByteStream $value a byte stream
     *
     * @return \NGS\ByteStream
     */
    public function setThumbnail($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "thumbnail" cannot be set to null because it is non-nullable!');
        $value = \NGS\ByteStream::fromBase64($value);
        $this->thumbnail = $value;
        return $value;
    }

    /**
     * @param \NGS\ByteStream $value a byte stream
     *
     * @return \NGS\ByteStream
     */
    public function setOriginal($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "original" cannot be set to null because it is non-nullable!');
        $value = \NGS\ByteStream::fromBase64($value);
        $this->original = $value;
        return $value;
    }

    /**
     * @param \NGS\ByteStream $value a byte stream
     *
     * @return \NGS\ByteStream
     */
    public function setEmail($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "email" cannot be set to null because it is non-nullable!');
        $value = \NGS\ByteStream::fromBase64($value);
        $this->email = $value;
        return $value;
    }

    /**
     * @param \NGS\ByteStream $value a byte stream
     *
     * @return \NGS\ByteStream
     */
    public function setWeb($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "web" cannot be set to null because it is non-nullable!');
        $value = \NGS\ByteStream::fromBase64($value);
        $this->web = $value;
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
        if ($name === 'kadaID')
            return $this->setKadaID($value); // a uuid
        if ($name === 'thumbnail')
            return $this->setThumbnail($value); // a byte stream
        if ($name === 'original')
            return $this->setOriginal($value); // a byte stream
        if ($name === 'email')
            return $this->setEmail($value); // a byte stream
        if ($name === 'web')
            return $this->setWeb($value); // a byte stream
        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageSave\Zahtjev" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'kadaID')
            throw new \LogicException('The property "kadaID" cannot be unset because it is non-nullable!'); // a uuid (cannot be unset)
        if ($name === 'thumbnail')
            throw new \LogicException('The property "thumbnail" cannot be unset because it is non-nullable!'); // a byte stream (cannot be unset)
        if ($name === 'original')
            throw new \LogicException('The property "original" cannot be unset because it is non-nullable!'); // a byte stream (cannot be unset)
        if ($name === 'email')
            throw new \LogicException('The property "email" cannot be unset because it is non-nullable!'); // a byte stream (cannot be unset)
        if ($name === 'web')
            throw new \LogicException('The property "web" cannot be unset because it is non-nullable!'); // a byte stream (cannot be unset)
    }

    public function toJson()
    {
        return \ImageSave\ZahtjevJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \ImageSave\ZahtjevJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'ImageSave\Zahtjev'.$this->toJson();
    }

    public function __clone()
    {
        return \ImageSave\ZahtjevArrayConverter::fromArray(\ImageSave\ZahtjevArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \ImageSave\ZahtjevArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\ImageSave\ZahtjevArrayConverter::toArray($this));
    }
}