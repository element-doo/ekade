<?php
namespace EmailProvjera;

require_once __DIR__.'/ZahtjevJsonConverter.php';
require_once __DIR__.'/ZahtjevArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property string $email a string
 * @property string $kadaID a string, can be null
 *
 * @package EmailProvjera
 * @version 0.9.9 beta
 */
class Zahtjev implements \IteratorAggregate
{
    protected $email;
    protected $kadaID;

    /**
     * Constructs object using a key-property array or instance of class "EmailProvjera\Zahtjev"
     *
     * @param array|void $data key-property array or instance of class "EmailProvjera\Zahtjev" or pass void to provide all fields with defaults
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
        if (array_key_exists('kadaID', $data))
            $this->setKadaID($data['kadaID']);
        unset($data['kadaID']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "EmailProvjera\Zahtjev" constructor: '.implode(', ', array_keys($data)));
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
     * @return a string, can be null
     */
    public function getKadaID()
    {
        return $this->kadaID;
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
        if ($name === 'kadaID')
            return $this->getKadaID(); // a string, can be null

        throw new \InvalidArgumentException('Property "'.$name.'" in class "EmailProvjera\Zahtjev" does not exist and could not be retrieved!');
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
        if ($name === 'kadaID')
            return $this->getKadaID() !== null; // a string, can be null

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
     * @param string $value a string, can be null
     *
     * @return string
     */
    public function setKadaID($value)
    {
        $value = $value !== null ? \NGS\Converter\PrimitiveConverter::toString($value) : null;
        $this->kadaID = $value;
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
        if ($name === 'kadaID')
            return $this->setKadaID($value); // a string, can be null
        throw new \InvalidArgumentException('Property "'.$name.'" in class "EmailProvjera\Zahtjev" does not exist and could not be set!');
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
        if ($name === 'kadaID')
            $this->setKadaID(null);; // a string, can be null
    }

    public function toJson()
    {
        return \EmailProvjera\ZahtjevJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \EmailProvjera\ZahtjevJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'EmailProvjera\Zahtjev'.$this->toJson();
    }

    public function __clone()
    {
        return \EmailProvjera\ZahtjevArrayConverter::fromArray(\EmailProvjera\ZahtjevArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \EmailProvjera\ZahtjevArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\EmailProvjera\ZahtjevArrayConverter::toArray($this));
    }
}
