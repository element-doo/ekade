<?php
namespace ImageResize;

require_once __DIR__.'/ZahtjevJsonConverter.php';
require_once __DIR__.'/ZahtjevArrayConverter.php';
require_once __DIR__.'/Slika.php';
require_once __DIR__.'/ResizeZahtjev.php';

/**
 * Generated from NGS DSL
 *
 * @property \ImageResize\Slika $slika an object of class "ImageResize\Slika"
 * @property array $zahtjevi an array of objects of class "ImageResize\ResizeZahtjev"
 *
 * @package ImageResize
 * @version 0.9.9 beta
 */
class Zahtjev implements \IteratorAggregate
{
    protected $slika;
    protected $zahtjevi;

    /**
     * Constructs object using a key-property array or instance of class "ImageResize\Zahtjev"
     *
     * @param array|void $data key-property array or instance of class "ImageResize\Zahtjev" or pass void to provide all fields with defaults
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
        if(!array_key_exists('slika', $data))
            $data['slika'] = new \ImageResize\Slika(); // an object of class "ImageResize\Slika"
        if(!array_key_exists('zahtjevi', $data))
            $data['zahtjevi'] = array(); // an array of objects of class "ImageResize\ResizeZahtjev"
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if (array_key_exists('slika', $data))
            $this->setSlika($data['slika']);
        unset($data['slika']);
        if (array_key_exists('zahtjevi', $data))
            $this->setZahtjevi($data['zahtjevi']);
        unset($data['zahtjevi']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "ImageResize\Zahtjev" constructor: '.implode(', ', array_keys($data)));
    }

// ============================================================================

    /**
     * @return an object of class "ImageResize\Slika"
     */
    public function getSlika()
    {
        return $this->slika;
    }

    /**
     * @return an array of objects of class "ImageResize\ResizeZahtjev"
     */
    public function getZahtjevi()
    {
        return $this->zahtjevi;
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
        if ($name === 'slika')
            return $this->getSlika(); // an object of class "ImageResize\Slika"
        if ($name === 'zahtjevi')
            return $this->getZahtjevi(); // an array of objects of class "ImageResize\ResizeZahtjev"

        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageResize\Zahtjev" does not exist and could not be retrieved!');
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
        if ($name === 'slika')
            return true; // an object of class "ImageResize\Slika" (always set)
        if ($name === 'zahtjevi')
            return true; // an array of objects of class "ImageResize\ResizeZahtjev" (always set)

        return false;
    }

    /**
     * @param \ImageResize\Slika $value an object of class "ImageResize\Slika"
     *
     * @return \ImageResize\Slika
     */
    public function setSlika($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "slika" cannot be set to null because it is non-nullable!');
        $value = \ImageResize\SlikaArrayConverter::fromArray($value);
        $this->slika = $value;
        return $value;
    }

    /**
     * @param array $value an array of objects of class "ImageResize\ResizeZahtjev"
     *
     * @return array
     */
    public function setZahtjevi($value)
    {
        if ($value === null)
            throw new \InvalidArgumentException('Property "zahtjevi" cannot be set to null because it is non-nullable!');
        $value = \ImageResize\ResizeZahtjevArrayConverter::fromArrayList($value);
        $this->zahtjevi = $value;
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
        if ($name === 'slika')
            return $this->setSlika($value); // an object of class "ImageResize\Slika"
        if ($name === 'zahtjevi')
            return $this->setZahtjevi($value); // an array of objects of class "ImageResize\ResizeZahtjev"
        throw new \InvalidArgumentException('Property "'.$name.'" in class "ImageResize\Zahtjev" does not exist and could not be set!');
    }

    /**
     * Will unset a property if it exists, but throw an exception if it is not nullable
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        if ($name === 'slika')
            throw new \LogicException('The property "slika" cannot be unset because it is non-nullable!'); // an object of class "ImageResize\Slika" (cannot be unset)
        if ($name === 'zahtjevi')
            throw new \LogicException('The property "zahtjevi" cannot be unset because it is non-nullable!'); // an array of objects of class "ImageResize\ResizeZahtjev" (cannot be unset)
    }

    public function toJson()
    {
        return \ImageResize\ZahtjevJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \ImageResize\ZahtjevJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'ImageResize\Zahtjev'.$this->toJson();
    }

    public function __clone()
    {
        return \ImageResize\ZahtjevArrayConverter::fromArray(\ImageResize\ZahtjevArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \ImageResize\ZahtjevArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\ImageResize\ZahtjevArrayConverter::toArray($this));
    }
}
