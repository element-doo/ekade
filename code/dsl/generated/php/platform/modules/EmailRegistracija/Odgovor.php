<?php
namespace EmailRegistracija;

require_once __DIR__.'/OdgovorJsonConverter.php';
require_once __DIR__.'/OdgovorArrayConverter.php';

/**
 * Generated from NGS DSL
 *
 * @property bool $odjavljen a boolean value
 * @property string $unsubscribeID a string
 *
 * @package EmailRegistracija
 * @version 0.9.9 beta
 */
class Odgovor implements \IteratorAggregate
{
    protected $odjavljen;
    protected $unsubscribeID;

    /**
     * Constructs object using a key-property array or instance of class "EmailRegistracija\Odgovor"
     *
     * @param array|void $data key-property array or instance of class "EmailRegistracija\Odgovor" or pass void to provide all fields with defaults
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
        if(!array_key_exists('odjavljen', $data))
            $data['odjavljen'] = false; // a boolean value
        if(!array_key_exists('unsubscribeID', $data))
            $data['unsubscribeID'] = ''; // a string
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (array_key_exists('odjavljen', $data))
            $this->setOdjavljen($data['odjavljen']);
        unset($data['odjavljen']);
        if (array_key_exists('unsubscribeID', $data))
            $this->setUnsubscribeID($data['unsubscribeID']);
        unset($data['unsubscribeID']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "EmailRegistracija\Odgovor" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return a boolean value
     */
    public function getOdjavljen()
    {
        return $this->odjavljen;
    }

    /**
     * @return a string
     */
    public function getUnsubscribeID()
    {
        return $this->unsubscribeID;
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
        if ($name === 'odjavljen')
            return $this->getOdjavljen(); // a boolean value
        if ($name === 'unsubscribeID')
            return $this->getUnsubscribeID(); // a string

        throw new \InvalidArgumentException('Property "'.$name.'" in class "EmailRegistracija\Odgovor" does not exist and could not be retrieved!');
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
        if ($name === 'odjavljen')
            return true; // a boolean value (always set)
        if ($name === 'unsubscribeID')
            return true; // a string (always set)

        return false;
    }

    /**
     * @param bool $value a boolean value
     *
     * @return bool
     */
    public function setOdjavljen($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "odjavljen" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toBoolean($value);
        $this->odjavljen = $value;
        return $value;
    }

    /**
     * @param string $value a string
     *
     * @return string
     */
    public function setUnsubscribeID($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "unsubscribeID" cannot be set to null because it is non-nullable!');
        $value = \NGS\Converter\PrimitiveConverter::toString($value);
        $this->unsubscribeID = $value;
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
        if ($name === 'odjavljen')
            return $this->setOdjavljen($value); // a boolean value
        if ($name === 'unsubscribeID')
            return $this->setUnsubscribeID($value); // a string
        throw new \InvalidArgumentException('Property "'.$name.'" in class "EmailRegistracija\Odgovor" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'odjavljen')
            throw new \LogicException('The property "odjavljen" cannot be unset because it is non-nullable!'); // a boolean value (cannot be unset)
        if ($name === 'unsubscribeID')
            throw new \LogicException('The property "unsubscribeID" cannot be unset because it is non-nullable!'); // a string (cannot be unset)
    }

    public function toJson()
    {
        return \EmailRegistracija\OdgovorJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \EmailRegistracija\OdgovorJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'EmailRegistracija\Odgovor'.$this->toJson();
    }

    public function __clone()
    {
        return \EmailRegistracija\OdgovorArrayConverter::fromArray(\EmailRegistracija\OdgovorArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \EmailRegistracija\OdgovorArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\EmailRegistracija\OdgovorArrayConverter::toArray($this));
    }
}