<?php
namespace Sigurnost;

require_once __DIR__.'/KorisnikJsonConverter.php';
require_once __DIR__.'/KorisnikArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property string $URI a unique object identifier (read-only)
 * @property string $username a string
 * @property string $salt a string
 * @property \NGS\ByteStream $hashSifra a byte stream
 *
 * @package Sigurnost
 * @version 0.9.9 beta
 */
class Korisnik extends \NGS\Patterns\AggregateRoot implements \IteratorAggregate
{
    protected $URI;
    protected $username;
    protected $salt;
    protected $hashSifra;

    /**
     * Constructs object using a key-property array or instance of class "Sigurnost\Korisnik"
     *
     * @param array|void $data key-property array or instance of class "Sigurnost\Korisnik" or pass void to provide all fields with defaults
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
        if(!array_key_exists('username', $data))
            $data['username'] = ''; // a string
        if(!array_key_exists('salt', $data))
            $data['salt'] = ''; // a string
        if(!array_key_exists('hashSifra', $data))
            $data['hashSifra'] = new \NGS\ByteStream(); // a byte stream
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
        if (array_key_exists('username', $data))
            $this->setUsername($data['username']);
        unset($data['username']);
        if (array_key_exists('salt', $data))
            $this->setSalt($data['salt']);
        unset($data['salt']);
        if (array_key_exists('hashSifra', $data))
            $this->setHashSifra($data['hashSifra']);
        unset($data['hashSifra']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "Sigurnost\Korisnik" constructor: '.implode(', ', array_keys($data)));
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return a string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @return a byte stream
     */
    public function getHashSifra()
    {
        return $this->hashSifra;
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
        if ($name === 'username')
            return $this->getUsername(); // a string
        if ($name === 'salt')
            return $this->getSalt(); // a string
        if ($name === 'hashSifra')
            return $this->getHashSifra(); // a byte stream

        throw new \InvalidArgumentException('Property "'.$name.'" in class "Sigurnost\Korisnik" does not exist and could not be retrieved!');
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
        if ($name === 'username')
            return true; // a string (always set)
        if ($name === 'salt')
            return true; // a string (always set)
        if ($name === 'hashSifra')
            return true; // a byte stream (always set)

        return false;
    }

    private static $_read_only_properties = array('URI');

    /**
     * @param string $value a string
     *
     * @return string
     */
    public function setUsername($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "username" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toString($value);
        $this->username = $value;
        return $value;
    }

    /**
     * @param string $value a string
     *
     * @return string
     */
    public function setSalt($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "salt" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toString($value);
        $this->salt = $value;
        return $value;
    }

    /**
     * @param \NGS\ByteStream $value a byte stream
     *
     * @return \NGS\ByteStream
     */
    public function setHashSifra($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "hashSifra" cannot be set to null because it is non-nullable!');
        $value = \NGS\ByteStream::fromBase64($value);
        $this->hashSifra = $value;
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
            throw new \LogicException('Property "'.$name.'" in "Sigurnost\Korisnik" cannot be set, because it is read-only!');
        if ($name === 'username')
            return $this->setUsername($value); // a string
        if ($name === 'salt')
            return $this->setSalt($value); // a string
        if ($name === 'hashSifra')
            return $this->setHashSifra($value); // a byte stream
        throw new \InvalidArgumentException('Property "'.$name.'" in class "Sigurnost\Korisnik" does not exist and could not be set!');
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
        if ($name === 'username')
            throw new \LogicException('The property "username" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
        if ($name === 'salt')
            throw new \LogicException('The property "salt" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
        if ($name === 'hashSifra')
            throw new \LogicException('The property "hashSifra" cannot be unset because it is non-nullable!'); // a byte stream (cannot be unset)
    }

    /**
     * Create or update Sigurnost\Korisnik instance (server call)
     *
     * @return modified instance object
     */
    public function persist()
    {

        $newObject = parent::persist();
        $this->updateWithAnother($newObject);

        return $this;
    }

    private function updateWithAnother(\Sigurnost\Korisnik $result)
    {
        $this->URI = $result->URI;

        $this->username = $result->username;
        $this->salt = $result->salt;
        $this->hashSifra = $result->hashSifra;
    }

    public function toJson()
    {
        return \Sigurnost\KorisnikJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \Sigurnost\KorisnikJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'Sigurnost\Korisnik'.$this->toJson();
    }

    public function __clone()
    {
        return \Sigurnost\KorisnikArrayConverter::fromArray(\Sigurnost\KorisnikArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \Sigurnost\KorisnikArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\Sigurnost\KorisnikArrayConverter::toArray($this));
    }
}
