<?php
namespace NGS\Patterns;

use InvalidArgumentException;
use NGS\Client\Exception\InvalidRequestException;
use NGS\Client\ReportingProxy;
use NGS\Patterns\GenericSearch;
use NGS\Patterns\Specification;
use NGS\Utils;

/**
 * Service for creating documents based on templates and data.
 * Data can be provided or specification can be sent so data is queried
 * on the server.
 * <p>
 * Byte array is returned from the server which represents docx, xlsx,
 * text or converted pdf file.
 * <p>
 * More info about Templater library can be found at {@link http://templater.info}
 */
class Templater
{
    private $class;
    private $file;

    /**
     * Creates a generic templater
     *
     * @param string $file Name of template file located on server
     * @param string $class Class name of domain object
     * @throws InvalidArgumentException If invalid arguments provided
     */
    public function __construct($file, $class=null)
    {
        $this->file  = $file;

        if ($class && is_string($class)) {
            if (!class_exists($class)) {
                throw new InvalidArgumentException('Cannot find domain object class "'.$class.'"');
            }
            $this->class = $class;
        } else if($class !== null) {
            throw new InvalidArgumentException('Class name was not a string');
        }
    }

    /**
     * Fills template with domain object
     *
     * @param string $uri
     * @return string Binary content of genarated template
     * @throws InvalidArgumentException If data source was invalid type
     */
    public function find($uri)
    {
        $proxy = new ReportingProxy();
        return $proxy->findTemplater($this->file, $this->class, $uri);
    }

    /**
     * Fills template with data returned from specification or generic search
     *
     * @param \NGS\Patterns\Specification|\NGS\Patterns\GenericSearch $source
     * data source
     * @return string Binary content of genarated template
     * @throws InvalidArgumentException If data source was invalid type
     */
    public function search($source)
    {
        $proxy = new ReportingProxy();
        if ($source instanceof Specification) {
            return $proxy->searchTemplater(
                $this->file,
                $source
            );
        }
        elseif ($source instanceof GenericSearch) {
            return $proxy->searchTemplaterGeneric(
                $this->file,
                $source
            );
        }
        else {
            throw new InvalidArgumentException('Cannot search templater with invalid typye "'.Utils::getType($source).'"');
        }
    }
}
