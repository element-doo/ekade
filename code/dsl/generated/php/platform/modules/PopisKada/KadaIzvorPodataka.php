<?php
namespace PopisKada;

require_once __DIR__.'/KadaIzvorPodatakaJsonConverter.php';
require_once __DIR__.'/KadaIzvorPodatakaArrayConverter.php';
require_once __DIR__.'/../Resursi/SlikeKade.php';

/**
 * Generated from NGS DSL
 *
 * @property string $URI a unique object identifier (read-only)
 * @property \NGS\Timestamp $odobrena a timestamp with time zone, can be null (read-only)
 * @property \NGS\Timestamp $odbijena a timestamp with time zone, can be null (read-only)
 * @property int $brojacSlanja an integer number (read-only)
 * @property \NGS\Timestamp $dodana a timestamp with time zone (read-only)
 * @property \Resursi\SlikeKade $slikeKade an object of class "Resursi\SlikeKade", can be null (read-only)
 *
 * @package PopisKada
 * @version 0.9.9 beta
 */
class KadaIzvorPodataka extends \NGS\Patterns\Identifiable implements \IteratorAggregate
{
    protected $URI;
    protected $odobrena;
    protected $odbijena;
    protected $brojacSlanja;
    protected $dodana;
    protected $slikeKade;

    /**
     * Constructs object using a key-property array or instance of class "PopisKada\KadaIzvorPodataka"
     *
     * @param array|void $data key-property array or instance of class "PopisKada\KadaIzvorPodataka" or pass void to provide all fields with defaults
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
        if(!array_key_exists('brojacSlanja', $data))
            $data['brojacSlanja'] = 0; // an integer number
        if(!array_key_exists('dodana', $data))
            $data['dodana'] = new \NGS\Timestamp(); // a timestamp with time zone
    }

    /**
     * Constructs object from a key-property array
     *
     * @param array $data key-property array
     */
    private function fromArray(array $data)
    {
        $this->provideDefaults($data);

        if(!array_key_exists('URI', $data) || $data['URI'] === null)
            throw new \LogicException('Snowflake must have non-nullable URI. It can\'t be constructed without URI!');
        $this->URI = \NGS\Converter\PrimitiveConverter::toString($data['URI']);
        unset($data['URI']);
        if (isset($data['odobrena']))
            $this->odobrena = new \NGS\Timestamp($data['odobrena']);
        unset($data['odobrena']);
        if (isset($data['odbijena']))
            $this->odbijena = new \NGS\Timestamp($data['odbijena']);
        unset($data['odbijena']);
        if (isset($data['brojacSlanja']))
            $this->brojacSlanja = \NGS\Converter\PrimitiveConverter::toInteger($data['brojacSlanja']);
        unset($data['brojacSlanja']);
        if (isset($data['dodana']))
            $this->dodana = new \NGS\Timestamp($data['dodana']);
        unset($data['dodana']);
        if (isset($data['slikeKade']))
            $this->slikeKade = \Resursi\SlikeKadeArrayConverter::fromArray($data['slikeKade']);
        unset($data['slikeKade']);

        if (count($data) !== 0 && \NGS\Utils::WarningsAsErrors())
            throw new \InvalidArgumentException('Superflous array keys found in "PopisKada\KadaIzvorPodataka" constructor: '.implode(', ', array_keys($data)));
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
     * @return a timestamp with time zone, can be null
     */
    public function getOdobrena()
    {
        return $this->odobrena;
    }

    /**
     * @return a timestamp with time zone, can be null
     */
    public function getOdbijena()
    {
        return $this->odbijena;
    }

    /**
     * @return an integer number
     */
    public function getBrojacSlanja()
    {
        return $this->brojacSlanja;
    }

    /**
     * @return a timestamp with time zone
     */
    public function getDodana()
    {
        return $this->dodana;
    }

    /**
     * @return an object of class "Resursi\SlikeKade", can be null
     */
    public function getSlikeKade()
    {
        return $this->slikeKade;
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
        if ($name === 'odobrena')
            return $this->getOdobrena(); // a timestamp with time zone, can be null
        if ($name === 'odbijena')
            return $this->getOdbijena(); // a timestamp with time zone, can be null
        if ($name === 'brojacSlanja')
            return $this->getBrojacSlanja(); // an integer number
        if ($name === 'dodana')
            return $this->getDodana(); // a timestamp with time zone
        if ($name === 'slikeKade')
            return $this->getSlikeKade(); // an object of class "Resursi\SlikeKade", can be null

        throw new \InvalidArgumentException('Property "'.$name.'" in class "PopisKada\KadaIzvorPodataka" does not exist and could not be retrieved!');
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
            return true;
        if ($name === 'odobrena')
            return $this->getOdobrena() !== null; // a timestamp with time zone, can be null
        if ($name === 'odbijena')
            return $this->getOdbijena() !== null; // a timestamp with time zone, can be null
        if ($name === 'brojacSlanja')
            return true; // an integer number (always set)
        if ($name === 'dodana')
            return true; // a timestamp with time zone (always set)
        if ($name === 'slikeKade')
            return $this->getSlikeKade() !== null; // an object of class "Resursi\SlikeKade", can be null

        return false;
    }

    /**
     * Property setter which throws an exception because snowflakes are read-only
     *
     * @param string $name Property name
     * @param mixed $value Property value
     */
    public function __set($name, $value)
    {
        throw new \LogicException('Property "'.$name.'" in "PopisKada\KadaIzvorPodataka" cannot be set, because all properties in snowflake are read-only!');
    }

    /**
     * Property unsetter which throws an exception because snowflakes are read-only
     *
     * @param string $name Property name to unset (set to null)
     */
    public function __unset($name)
    {
        throw new \LogicException('The property "'.$name.'" cannot be unset because snowflake properties are read-only!');
    }

    public function toJson()
    {
        return \PopisKada\KadaIzvorPodatakaJsonConverter::toJson($this);
    }

    public static function fromJson($item)
    {
        return \PopisKada\KadaIzvorPodatakaJsonConverter::fromJson($item);
    }

    public function __toString()
    {
        return 'PopisKada\KadaIzvorPodataka'.$this->toJson();
    }

    public function __clone()
    {
        return \PopisKada\KadaIzvorPodatakaArrayConverter::fromArray(\PopisKada\KadaIzvorPodatakaArrayConverter::toArray($this));
    }

    public function toArray()
    {
        return \PopisKada\KadaIzvorPodatakaArrayConverter::toArray($this);
    }

    /**
     * Implementation of the IteratorAggregate interface via \ArrayIterator
     *
     * @return Traversable a new iterator specially created for this iteratation
     */
    public function getIterator()
    {
        return new \ArrayIterator(\PopisKada\KadaIzvorPodatakaArrayConverter::toArray($this));
    }

    /**
     * Find data using declared specification NemoderiraneKade
     * Search can be limited by $searchLimit and $searchOffset integer arguments
     *
     * @return array of objects that satisfy specification
     */
    public static function NemoderiraneKade($searchLimit = null, $searchOffset = null)
    {
        require_once __DIR__.'/KadaIzvorPodataka/NemoderiraneKade.php';
        $specification = new \PopisKada\KadaIzvorPodataka\NemoderiraneKade();
        return $specification->search($searchLimit, $searchOffset);
    }

    /**
     * Find data using declared specification OdobreneKade
     * Search can be limited by $searchLimit and $searchOffset integer arguments
     *
     * @return array of objects that satisfy specification
     */
    public static function OdobreneKade($searchLimit = null, $searchOffset = null)
    {
        require_once __DIR__.'/KadaIzvorPodataka/OdobreneKade.php';
        $specification = new \PopisKada\KadaIzvorPodataka\OdobreneKade();
        return $specification->search($searchLimit, $searchOffset);
    }
}