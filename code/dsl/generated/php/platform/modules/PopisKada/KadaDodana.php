<?php
namespace PopisKada;

require_once __DIR__.'/KadaDodanaJsonConverter.php';
require_once __DIR__.'/KadaDodanaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property string $URI a unique object identifier (read-only)
 * @property \NGS\UUID $kadaID a uuid
 * @property \Resursi\Fingerprint $digest an object of class "Resursi\Fingerprint"
 * @property \Resursi\PodaciSlike $original an object of class "Resursi\PodaciSlike"
 * @property \Resursi\PodaciSlike $web an object of class "Resursi\PodaciSlike"
 * @property \Resursi\PodaciSlike $email an object of class "Resursi\PodaciSlike"
 * @property \Resursi\PodaciSlike $thumbnail an object of class "Resursi\PodaciSlike"
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
class KadaDodana extends \NGS\Patterns\DomainEvent
{
    protected $URI;
    protected $kadaID;
    protected $digest;
    protected $original;
    protected $web;
    protected $email;
    protected $thumbnail;

    /**
     * Constructs object using a key-property array or instance of class "PopisKada\KadaDodana"
     *
     * @param array|void $data key-property array or instance of class "PopisKada\KadaDodana" or pass void to provide all fields with defaults
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
        if(!array_key_exists('URI', $data))
            $data['URI'] = null; //a string representing a unique object identifier
        if(!array_key_exists('kadaID', $data))
            $data['kadaID'] = new \NGS\UUID(); // a uuid
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
        if (array_key_exists('kadaID', $data))
            $this->setKadaID($data['kadaID']);
        unset($data['kadaID']);
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
            throw new \InvalidArgumentException('Superflous array keys found in "PopisKada\KadaDodana" constructor: '.implode(', ', array_keys($data)));
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
    public function getKadaID()
    {
        return $this->kadaID;
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
        if ($name === 'kadaID')
            return $this->getKadaID(); // a uuid
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

        throw new \InvalidArgumentException('Property "'.$name.'" in class "PopisKada\KadaDodana" does not exist and could not be retrieved!');
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
        if ($name === 'kadaID')
            return true; // a uuid (always set)
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
     * Property setter which checks for invalid access to domain event properties and enforces proper type checks
     *
     * @param string $name Property name
     * @param mixed $value Property value
     */
    public function __set($name, $value)
    {
        if ($name === 'URI')
            throw new \LogicException('Property "URI" in "PopisKada\KadaDodana" cannot be set, because event URI is populated by server!');
        if ($name === 'kadaID')
            return $this->setKadaID($value); // a uuid
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
        throw new \InvalidArgumentException('Property "'.$name.'" in class "PopisKada\KadaDodana" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'URI')
            throw new \LogicException('The property "URI" cannot be unset because event URI is created by server!');
        if ($name === 'kadaID')
            throw new \LogicException('The property "kadaID" cannot be unset because it is non-nullable!'); // a uuid (cannot be unset)
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

    public function toJson()
    {
        return \PopisKada\KadaDodanaJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \PopisKada\KadaDodanaJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'PopisKada\KadaDodana'.$this->toJson();
    }

    public function __clone()
    {
        return \PopisKada\KadaDodanaArrayConverter::fromArray(\PopisKada\KadaDodanaArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \PopisKada\KadaDodanaArrayConverter::toArray($this);
    }
}
