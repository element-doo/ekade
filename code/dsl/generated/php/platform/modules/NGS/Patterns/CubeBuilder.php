<?php
namespace NGS\Patterns;

require_once(__DIR__.'/../Converter/PrimitiveConverter.php');
require_once(__DIR__.'/../Client/DomainProxy.php');
require_once(__DIR__.'/OlapCube.php');
require_once(__DIR__.'/../Utils.php');

use \NGS\Client\DomainProxy;
use \NGS\Converter\PrimitiveConverter;
use \NGS\Patterns\OlapCube;
use \NGS\Utils;

/**
 * Helper for createing and analyizing OLAP cubes
 *
 * Example:
 * <code>
 * $builder = new CubeBuilder('My\Cube');
 * $rows = $builder->dimension('money')
 *                 ->facts('total', 'average')
 *                 ->descending('average')
 *                 ->analyze();
 * </code>
 */
class CubeBuilder
{
    protected $cube;
    protected $dimensions = array();
    protected $facts = array();
    protected $order = array();
    protected $specification;

    /**
     * Create new builder on cube
     *
     * @param OlapCube $cube
     */
    public function __construct(OlapCube $cube)
    {
        $this->cube = $cube;
    }

    /**
     * Add single dimension to cube
     *
     * @param $dimension A valid dimension
     * @return $this
     * @throws \InvalidArgumentException Invalid type or not a valid dimension
     * for given cube
     */
    public function dimension($dimension)
    {
        if (!is_string($dimension)) {
            throw new \InvalidArgumentException('Dimension must be a string. Invalid type "'.Utils::getType($dimension).'" given for cube "'.get_class($this->cube).'"');
        }
        if (!in_array($dimension, $this->cube->getDimensions())) {
            throw new \InvalidArgumentException('Property '.$dimension.' is not a valid dimension for cube '.get_class($this->cube));
        }
        if (!in_array($dimension, $this->dimensions)) {
            $this->dimensions[] = $dimension;
        }
        return $this;
    }

    /**
     * Add multiple dimensions to cube
     *
     * @param array $dimensions
     * @internal param array $dimension Valid dimensions
     * @return $this
     */
    public function dimensions(array $dimensions)
    {
        foreach ($dimensions as $dim) {
            $this->dimension($dim);
        }
        return $this;
    }

    /**
     * Add single fact to cube
     *
     * @param $fact string A valid fact
     * @return $this
     * @throws \InvalidArgumentException Invalid type or not a valid fact for
     * given cube
     */
    public function fact($fact)
    {
        if (!is_string($fact)) {
            throw new \InvalidArgumentException('Fact must be a string. Invalid type "'.Utils::getType($fact).'" given for cube "'.get_class($this->cube).'"');
        }
        if (!in_array($fact, $this->cube->getFacts())) {
            throw new \InvalidArgumentException('Property '.$fact.' is not a valid fact for cube '.get_class($this->cube));
        }
        if (!in_array($fact, $this->facts)) {
            $this->facts[] = $fact;
        }
        return $this;
    }

    /**
     * Add multiple facts to cube
     *
     * @param $fact array Valid facts
     * @return $this
     * @throws \InvalidArgumentException Invalid type or not a valid fact
     * for given cube
     */
    public function facts(array $facts)
    {
        foreach ($facts as $fact) {
            $this->fact($fact);
        }
        return $this;
    }

    /**
     * Adds single dimension or facts to cube
     *
     * @param $dimensionOrFact string A valid dimension or fact
     * @return $this
     * @throws \InvalidArgumentException Invalid type or not a valid fact or
     * dimension for given cube
     */
    public function add($dimensionOrFact)
    {
        if (!is_string($dimensionOrFact)) {
            throw new \InvalidArgumentException('Dimension or fact must be a string, invalid type "'.Utils::getType($dimensionOrFact).'" given for cube '.get_class($this->cube));
        }
        if (in_array($dimensionOrFact, $this->cube->getDimensions())) {
            $this->dimension($dimensionOrFact);
        } elseif (in_array($dimensionOrFact, $this->cube->getFacts())) {
            $this->fact($dimensionOrFact);
        } else {
            throw new \InvalidArgumentException('Invalid fact or dimension "'.$dimensionOrFact.'" for cube '.get_class($this->cube));
        }
        return $this;
    }

    /**
     * Order ascending by dimension or fact
     *
     * @param $dimensionOrFact string A valid dimension or fact
     * @return $this
     */
    public function ascending ($dimensionOrFact)
    {
        $this->validateDimensionOrFact($dimensionOrFact);
        $this->order[$dimensionOrFact] = true;
        return $this;
    }

    /**
     * @see CubeBuilder::ascending
     */
    public function asc($dimensionOrFact)
    {
        return $this->ascending($dimensionOrFact);
    }

    /**
     * Order descending by dimension or fact
     *
     * @param $dimensionOrFact string A valid dimension or fact
     * @return $this
     */
    public function descending ($dimensionOrFact)
    {
        $this->validateDimensionOrFact($dimensionOrFact);
        $this->order[$dimensionOrFact] = false;
        return $this;
    }

    /**
     * @see CubeBuilder::descending
     */
    public function desc($dimensionOrFact)
    {
        return $this->descending($dimensionOrFact);
    }

    /**
     * Use specification in cube analysis
     *
     * @param Specification
     * @return $this
     */
    public function with(Specification $specification)
    {
        $this->specification = $specification;
        return $this;
    }

    /**
     * Execute cube analysis with builder settings
     *
     * @return array Resulting rows
     */
    public function analyze()
    {
        return $this->cube->analyze(
            $this->dimensions,
            $this->facts,
            $this->order,
            $this->specification
        );
    }

    /**
     * Check if dimension or fact is valid for cube used in builder
     *
     * @param $name
     * @throws \InvalidArgumentException
     */
    private function validateDimensionOrFact($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Dimension or fact for cube "'.get_class($this->cube).'"" was not a string');
        }
        if (!in_array($name, $this->cube->getDimensions()) && !in_array($name, $this->cube->getFacts())) {
            throw new \InvalidArgumentException('Invalid fact or dimension "'.$name.'" for cube '.get_class($this->cube));
        }
    }
}
