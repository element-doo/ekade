<?php
namespace NGS\Patterns;

require_once(__DIR__.'/../Client/RestHttp.php');
require_once(__DIR__.'/../Client/StandardProxy.php');
require_once(__DIR__.'/Specification.php');
require_once(__DIR__.'/CubeBuilder.php');

use \NGS\Client\RestHttp;
use \NGS\Client\StandardProxy;
use \NGS\Patterns\Specification;
use \NGS\Patterns\CubeBuilder;

abstract class OlapCube
{
    /**
     * @var \Ngs\Client\RestHttp
     */
    protected $restHttp;

    /**
     * @return array Get available dimensions
     */
    public abstract function getDimensions();

    /**
     * @return array Get available facts
     */
    public abstract function getFacts();

    /**
     * Constructs object using target server proxy
     *
     * @param \NGS\Client\RestHttp|void $restHttp to target server used for analysis
     */
    public function __construct(RestHttp $restHttp = null)
    {
        if ($restHttp === null) {
            $restHttp = RestHttp::instance();
        }
        $this->restHttp = $restHttp;
    }

    public function builder()
    {
        return new CubeBuilder($this);
    }

    /**
     * Populate cube
     *
     * @return \NGS\Patterns\OlapCube Populated cube object
     */
    public function analyze(
        array $dimensions,
        array $facts = array(),
        array $order = array(),
        Specification $specification = null)
    {
        $proxy = new StandardProxy($this->restHttp);
        return $specification === null
            ? $proxy->olapCube($this, $dimensions, $facts, $order)
            : $proxy->olapCubeWithSpecification($this, $specification, $dimensions, $facts, $order);
    }
}
