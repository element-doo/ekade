<?php
namespace Resursi;

require_once __DIR__.'/SlikeKadeJsonConverter.php';
require_once __DIR__.'/SlikeKadeArrayConverter.php';
require_once __DIR__.'/../PopisKada/Kada.php';
require_once __DIR__.'/Fingerprint.php';
require_once __DIR__.'/PodaciSlike.php';

/**
 * Generated from NGS DSL
 *
 * @property string $URI a unique object identifier (read-only)
 * @property \NGS\UUID $ID used by reference $kada (read-only)
 * @property string $kadaURI reference to an object of class "PopisKada\Kada" (read-only)
 * @property \PopisKada\Kada $kada an object of class "PopisKada\Kada"
 * @property \Resursi\Fingerprint $digest an object of class "Resursi\Fingerprint"
 * @property \Resursi\PodaciSlike $original an object of class "Resursi\PodaciSlike"
 * @property \Resursi\PodaciSlike $web an object of class "Resursi\PodaciSlike"
 * @property \Resursi\PodaciSlike $email an object of class "Resursi\PodaciSlike"
 * @property \Resursi\PodaciSlike $thumbnail an object of class "Resursi\PodaciSlike"
 *
 * @package Resursi
 * @version 0.9.9 beta
 */
class SlikeKade extends \NGS\Patterns\AggregateRoot implements \IteratorAggregate
{
    protected $URI;
    protected $ID;
    protected $kadaURI;
    protected $kada;
    protected $digest;
    protected $original;
    protected $web;
    protected $email;
    protected $thumbnail;

    /**
     * Constructs object using a key-property array or instance of class "Resursi\SlikeKade"
     *
     * @param array|void $data key-property array or instance of class "Resursi\SlikeKade" or pass void to provide all fields with defaults
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
            $data['ID'] = new \NGS\UUID(); // a uuid
        if(!array_key_exists('digest', $data))
            $data['digest'] = new \Resursi\Fingerprint(); // an object of class "Resursi\Fingerprint"
        if(!array_key_exists('original', $data))
            $data['original'] = new \Resursi\PodaciSlike(); // an object of class "Resursi\PodaciSlike"
        if(!array_key_exists('web', $data))
            $data['web'] = new \Resursi\PodaciSlike(); // an object of class "Resursi\PodaciSlike"
        if(!array_key_exists('email', $data))
            $data['email'] = new \Resursi\PodaciSlike(); // an object of class "Resursi\PodaciSlike"
        if(!array_key_exists('thumbnail', $data))
            $data['thumbnail'] = new \Resursi\PodaciSlike(); // an object of class "Resursi\PodaciSlike"
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
        if (array_key_exists('kada', $data))
            $this->setKada($data['kada']);
        unset($data['kada']);
        if(array_key_exists('kadaURI', $data))
            $this->kadaURI = \NGS\Converter\PrimitiveConverter::toString($data['kadaURI']);
        unset($data['kadaURI']);
        if (array_key_exists('digest', $data))
            $this->setDigest($data['digest']);
        unset($data['digest']);
        if (array_key_exists('original', $data))
            $this->setOriginal($data['original']);
        unset($data['original']);
        if (array_key_exists('web', $data))
            $this->setWeb($data['web']);
        unset($data['web']);
        if (array_key_exists('email', $data))
            $this->setEmail($data['email']);
        unset($data['email']);
        if (array_key_exists('thumbnail', $data))
            $this->setThumbnail($data['thumbnail']);
        unset($data['thumbnail']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "Resursi\SlikeKade" constructor: '.implode(', ', array_keys($data)));
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
     * @return a uuid
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @return a reference to an object of class "PopisKada\Kada"
     */
    public function getKadaURI()
    {
        return $this->kadaURI;
    }

    /**
     * @return an object of class "PopisKada\Kada"
     */
    public function getKada()
    {
        if ($this->kadaURI !== null && $this->kada === null)
            $this->kada = \NGS\Patterns\Repository::instance()->find('PopisKada\\Kada', $this->kadaURI);
        return $this->kada;
    }

    /**
     * @return an object of class "Resursi\Fingerprint"
     */
    public function getDigest()
    {
        return $this->digest;
    }

    /**
     * @return an object of class "Resursi\PodaciSlike"
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * @return an object of class "Resursi\PodaciSlike"
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * @return an object of class "Resursi\PodaciSlike"
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return an object of class "Resursi\PodaciSlike"
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
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
            return $this->getID(); // a uuid
        if ($name === 'kadaURI')
            return $this->getKadaURI(); // a reference to an object of class "PopisKada\Kada"
        if ($name === 'kada')
            return $this->getKada(); // an object of class "PopisKada\Kada"
        if ($name === 'digest')
            return $this->getDigest(); // an object of class "Resursi\Fingerprint"
        if ($name === 'original')
            return $this->getOriginal(); // an object of class "Resursi\PodaciSlike"
        if ($name === 'web')
            return $this->getWeb(); // an object of class "Resursi\PodaciSlike"
        if ($name === 'email')
            return $this->getEmail(); // an object of class "Resursi\PodaciSlike"
        if ($name === 'thumbnail')
            return $this->getThumbnail(); // an object of class "Resursi\PodaciSlike"

        throw new \InvalidArgumentException('Property "'.$name.'" in class "Resursi\SlikeKade" does not exist and could not be retrieved!');
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
        if ($name === 'kada')
            return true; // an object of class "PopisKada\Kada" (always set)
        if ($name === 'digest')
            return true; // an object of class "Resursi\Fingerprint" (always set)
        if ($name === 'original')
            return true; // an object of class "Resursi\PodaciSlike" (always set)
        if ($name === 'web')
            return true; // an object of class "Resursi\PodaciSlike" (always set)
        if ($name === 'email')
            return true; // an object of class "Resursi\PodaciSlike" (always set)
        if ($name === 'thumbnail')
            return true; // an object of class "Resursi\PodaciSlike" (always set)

        return false;
    }

    private static $_read_only_properties = array('URI', 'ID', 'kadaURI');

    /**
     * @param \NGS\UUID $value a uuid
     *
     * @return \NGS\UUID
     */
    private function setID($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "ID" cannot be set to null because it is non-nullable!');
        $value = new \NGS\UUID($value);
        $this->ID = $value;
        return $value;
    }

    /**
     * @param \PopisKada\Kada $value an object of class "PopisKada\Kada"
     *
     * @return \PopisKada\Kada
     */
    public function setKada($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "kada" cannot be set to null because it is non-nullable!');
        $value = \PopisKada\KadaArrayConverter::fromArray($value);
        if ($value->URI === null)
            throw new \InvalidArgumentException('Value of property "kada" cannot have URI set to null because it\'s a reference! Reference values must have non-null URIs!');
        $this->kada = $value;
        $this->kadaURI = $value->URI;
        $this->ID = $value->ID;
        return $value;
    }

    /**
     * @param \Resursi\Fingerprint $value an object of class "Resursi\Fingerprint"
     *
     * @return \Resursi\Fingerprint
     */
    public function setDigest($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "digest" cannot be set to null because it is non-nullable!');
        $value = \Resursi\FingerprintArrayConverter::fromArray($value);
        $this->digest = $value;
        return $value;
    }

    /**
     * @param \Resursi\PodaciSlike $value an object of class "Resursi\PodaciSlike"
     *
     * @return \Resursi\PodaciSlike
     */
    public function setOriginal($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "original" cannot be set to null because it is non-nullable!');
        $value = \Resursi\PodaciSlikeArrayConverter::fromArray($value);
        $this->original = $value;
        return $value;
    }

    /**
     * @param \Resursi\PodaciSlike $value an object of class "Resursi\PodaciSlike"
     *
     * @return \Resursi\PodaciSlike
     */
    public function setWeb($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "web" cannot be set to null because it is non-nullable!');
        $value = \Resursi\PodaciSlikeArrayConverter::fromArray($value);
        $this->web = $value;
        return $value;
    }

    /**
     * @param \Resursi\PodaciSlike $value an object of class "Resursi\PodaciSlike"
     *
     * @return \Resursi\PodaciSlike
     */
    public function setEmail($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "email" cannot be set to null because it is non-nullable!');
        $value = \Resursi\PodaciSlikeArrayConverter::fromArray($value);
        $this->email = $value;
        return $value;
    }

    /**
     * @param \Resursi\PodaciSlike $value an object of class "Resursi\PodaciSlike"
     *
     * @return \Resursi\PodaciSlike
     */
    public function setThumbnail($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "thumbnail" cannot be set to null because it is non-nullable!');
        $value = \Resursi\PodaciSlikeArrayConverter::fromArray($value);
        $this->thumbnail = $value;
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
            throw new \LogicException('Property "'.$name.'" in "Resursi\SlikeKade" cannot be set, because it is read-only!');
        if ($name === 'kada')
            return $this->setKada($value); // an object of class "PopisKada\Kada"
        if ($name === 'digest')
            return $this->setDigest($value); // an object of class "Resursi\Fingerprint"
        if ($name === 'original')
            return $this->setOriginal($value); // an object of class "Resursi\PodaciSlike"
        if ($name === 'web')
            return $this->setWeb($value); // an object of class "Resursi\PodaciSlike"
        if ($name === 'email')
            return $this->setEmail($value); // an object of class "Resursi\PodaciSlike"
        if ($name === 'thumbnail')
            return $this->setThumbnail($value); // an object of class "Resursi\PodaciSlike"
        throw new \InvalidArgumentException('Property "'.$name.'" in class "Resursi\SlikeKade" does not exist and could not be set!');
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
        if ($name === 'kada')
            throw new \LogicException('The property "kada" cannot be unset because it is non-nullable!'); // an object of class "PopisKada\Kada" (cannot be unset)
        if ($name === 'digest')
            throw new \LogicException('The property "digest" cannot be unset because it is non-nullable!'); // an object of class "Resursi\Fingerprint" (cannot be unset)
        if ($name === 'original')
            throw new \LogicException('The property "original" cannot be unset because it is non-nullable!'); // an object of class "Resursi\PodaciSlike" (cannot be unset)
        if ($name === 'web')
            throw new \LogicException('The property "web" cannot be unset because it is non-nullable!'); // an object of class "Resursi\PodaciSlike" (cannot be unset)
        if ($name === 'email')
            throw new \LogicException('The property "email" cannot be unset because it is non-nullable!'); // an object of class "Resursi\PodaciSlike" (cannot be unset)
        if ($name === 'thumbnail')
            throw new \LogicException('The property "thumbnail" cannot be unset because it is non-nullable!'); // an object of class "Resursi\PodaciSlike" (cannot be unset)
    }

    /**
     * Create or update Resursi\SlikeKade instance (server call)
     *
     * @return modified instance object
     */
    public function persist()
    {

        if ($this->kadaURI === null && $this->ID !== null) {
            throw new \LogicException('Cannot persist instance of "Resursi\SlikeKade" because reference "kada" was not assigned');
        }
        $newObject = parent::persist();
        $this->updateWithAnother($newObject);

        return $this;
    }

    private function updateWithAnother(\Resursi\SlikeKade $result)
    {
        $this->URI = $result->URI;

        $this->ID = $result->ID;
        $this->kada = $result->kada;
        $this->kadaURI = $result->kadaURI;
        $this->digest = $result->digest;
        $this->original = $result->original;
        $this->web = $result->web;
        $this->email = $result->email;
        $this->thumbnail = $result->thumbnail;
    }

    public function toJson()
    {
        return \Resursi\SlikeKadeJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \Resursi\SlikeKadeJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'Resursi\SlikeKade'.$this->toJson();
    }

    public function __clone()
    {
        return \Resursi\SlikeKadeArrayConverter::fromArray(\Resursi\SlikeKadeArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \Resursi\SlikeKadeArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\Resursi\SlikeKadeArrayConverter::toArray($this));
    }
}