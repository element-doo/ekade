<?php
namespace ImageResize;

require_once __DIR__.'/OdgovorJsonConverter.php';
require_once __DIR__.'/OdgovorArrayConverter.php';
require_once __DIR__.'/Slika.php';

/**
 * Generated from NGS DSL
 *
 * @property array $odgovori an array of objects of class "ImageResize\Slika"
 *
 * @package ImageResize
 * @version 0.9.9 beta
 */
class Odgovor implements \IteratorAggregate
{
    protected $odgovori;

    /**
     * Constructs object using a key-property array or instance of class "ImageResize\Odgovor"
     *
     * @param array|void $data key-property array or instance of class "ImageResize\Odgovor" or pass void to provide all fields with defaults
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
        if(!array_key_exists('odgovori', $data))
            $data['odgovori'] = array(); // an array of objects of class "ImageResize\Slika"
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (array_key_exists('odgovori', $data))
            $this->setOdgovori($data['odgovori']);
        unset($data['odgovori']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "ImageResize\Odgovor" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return an array of objects of class "ImageResize\Slika"
     */
    public function getOdgovori()
    {
        return $this->odgovori;
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
        if ($name === 'odgovori')
            return $this->getOdgovori(); // an array of objects of class "ImageResize\Slika"

        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageResize\Odgovor" does not exist and could not be retrieved!');
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
        if ($name === 'odgovori')
            return true; // an array of objects of class "ImageResize\Slika" (always set)

        return false;
    }

    /**
     * @param array $value an array of objects of class "ImageResize\Slika"
     *
     * @return array
     */
    public function setOdgovori($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "odgovori" cannot be set to null because it is non-nullable!');
        $value = \ImageResize\SlikaArrayConverter::fromArrayList($value);
        $this->odgovori = $value;
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
        if ($name === 'odgovori')
            return $this->setOdgovori($value); // an array of objects of class "ImageResize\Slika"
        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageResize\Odgovor" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'odgovori')
            throw new \LogicException('The property "odgovori" cannot be unset because it is non-nullable!'); // an array of objects of class "ImageResize\Slika" (cannot be unset)
    }

    public function toJson()
    {
        return \ImageResize\OdgovorJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \ImageResize\OdgovorJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'ImageResize\Odgovor'.$this->toJson();
    }

    public function __clone()
    {
        return \ImageResize\OdgovorArrayConverter::fromArray(\ImageResize\OdgovorArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \ImageResize\OdgovorArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\ImageResize\OdgovorArrayConverter::toArray($this));
    }
}
