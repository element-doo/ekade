<?php
namespace PopisKada;

require_once __DIR__.'/MasovnaModeracijaJsonConverter.php';
require_once __DIR__.'/MasovnaModeracijaArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property string $URI a unique object identifier (read-only)
 * @property array $moderacijeKada an array of objects of class "PopisKada\ModeriranaKada"
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
class MasovnaModeracija extends \NGS\Patterns\DomainEvent
{
    protected $URI;
    protected $moderacijeKada;

    /**
     * Constructs object using a key-property array or instance of class "PopisKada\MasovnaModeracija"
     *
     * @param array|void $data key-property array or instance of class "PopisKada\MasovnaModeracija" or pass void to provide all fields with defaults
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
        if(!array_key_exists('moderacijeKada', $data))
            $data['moderacijeKada'] = array(); // an array of objects of class "PopisKada\ModeriranaKada"
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
        if (array_key_exists('moderacijeKada', $data))
            $this->setModeracijeKada($data['moderacijeKada']);
        unset($data['moderacijeKada']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "PopisKada\MasovnaModeracija" constructor: '.implode(', ', array_keys($data)));
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
     * @return an array of objects of class "PopisKada\ModeriranaKada"
     */
    public function getModeracijeKada()
    {
        return $this->moderacijeKada;
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
        if ($name === 'moderacijeKada')
            return $this->getModeracijeKada(); // an array of objects of class "PopisKada\ModeriranaKada"

        throw new \InvalidArgumentException('Property "'.$name.'" in class "PopisKada\MasovnaModeracija" does not exist and could not be retrieved!');
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
        if ($name === 'moderacijeKada')
            return true; // an array of objects of class "PopisKada\ModeriranaKada" (always set)

        return false;
    }

    /**
     * @param array $value an array of objects of class "PopisKada\ModeriranaKada"
     *
     * @return array
     */
    public function setModeracijeKada($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "moderacijeKada" cannot be set to null because it is non-nullable!');
        $value = \PopisKada\ModeriranaKadaArrayConverter::fromArrayList($value, false);
        $this->moderacijeKada = $value;
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
            throw new \LogicException('Property "URI" in "PopisKada\MasovnaModeracija" cannot be set, because event URI is populated by server!');
        if ($name === 'moderacijeKada')
            return $this->setModeracijeKada($value); // an array of objects of class "PopisKada\ModeriranaKada"
        throw new \InvalidArgumentException('Property "'.$name.'" in class "PopisKada\MasovnaModeracija" does not exist and could not be set!');
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
        if ($name === 'moderacijeKada')
            throw new \LogicException('The property "moderacijeKada" cannot be unset because it is non-nullable!'); // an array of objects of class "PopisKada\ModeriranaKada" (cannot be unset)
    }

    public function toJson()
    {
        return \PopisKada\MasovnaModeracijaJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \PopisKada\MasovnaModeracijaJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'PopisKada\MasovnaModeracija'.$this->toJson();
    }

    public function __clone()
    {
        return \PopisKada\MasovnaModeracijaArrayConverter::fromArray(\PopisKada\MasovnaModeracijaArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \PopisKada\MasovnaModeracijaArrayConverter::toArray($this);
    }
}
