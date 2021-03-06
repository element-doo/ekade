<?php
namespace EmailRegistracija;

require_once __DIR__.'/ZahtjevJsonConverter.php';
require_once __DIR__.'/ZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property string $email a string
 *
 * @package EmailRegistracija
 * @version 0.9.9 beta
 */
class Zahtjev implements \IteratorAggregate
{
    protected $email;

    /**
     * Constructs object using a key-property array or instance of class "EmailRegistracija\Zahtjev"
     *
     * @param array|void $data key-property array or instance of class "EmailRegistracija\Zahtjev" or pass void to provide all fields with defaults
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
        if(!array_key_exists('email', $data))
            $data['email'] = ''; // a string
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (array_key_exists('email', $data))
            $this->setEmail($data['email']);
        unset($data['email']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "EmailRegistracija\Zahtjev" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return a string
     */
    public function getEmail()
    {
        return $this->email;
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
        if ($name === 'email')
            return $this->getEmail(); // a string

        throw new \InvalidArgumentException('Property "'.$name.'" in class "EmailRegistracija\Zahtjev" does not exist and could not be retrieved!');
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
        if ($name === 'email')
            return true; // a string (always set)

        return false;
    }

    /**
     * @param string $value a string
     *
     * @return string
     */
    public function setEmail($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "email" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toString($value);
        $this->email = $value;
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
        if ($name === 'email')
            return $this->setEmail($value); // a string
        throw new \InvalidArgumentException('Property "'.$name.'" in class "EmailRegistracija\Zahtjev" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'email')
            throw new \LogicException('The property "email" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
    }

    public function toJson()
    {
        return \EmailRegistracija\ZahtjevJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \EmailRegistracija\ZahtjevJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'EmailRegistracija\Zahtjev'.$this->toJson();
    }

    public function __clone()
    {
        return \EmailRegistracija\ZahtjevArrayConverter::fromArray(\EmailRegistracija\ZahtjevArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \EmailRegistracija\ZahtjevArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\EmailRegistracija\ZahtjevArrayConverter::toArray($this));
    }
}