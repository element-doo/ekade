<?php
namespace NGS\Client;

require_once(__DIR__.'/../Utils.php');
require_once(__DIR__.'/../Name.php');
require_once(__DIR__.'/RestHttp.php');
require_once(__DIR__.'/../Patterns/Repository.php');

use NGS\Name;
use NGS\Patterns\AggregateRoot;
use NGS\Patterns\Repository;
use NGS\Utils;

/**
 * Proxy service to remote CRUD REST-like API.
 * Single aggregate root instance can be used.
 * New object instance will be returned when doing modifications.
 * All commands are performed on a single aggregate root.
 * Use {@see StandardProxy} when response is not required, or for bulk
 * versions of CRUD commands.
 * It is preferred to use domain patterns instead of this proxy service.
 *
 * @package NGS\Client
 */
class CrudProxy
{
    const CRUD_URI = 'Crud.svc';

    protected $http;

    protected static $instance;

    /**
     * Create a new CrudProxy instance
     *
     * @param RestHttp $http RestHttp instance used for http request.
     * Optionally specify an instance, otherwise use a singleton instance
     */
    public function __construct(RestHttp $http = null)
    {
        $this->http = $http !== null ? $http : RestHttp::instance();
    }

    /**
     * Gets singleton instance of Crud.svc proxy
     *
     * @return CrudProxy
     */
    public static function instance()
    {
        if(self::$instance === null)
            self::$instance = new CrudProxy();
        return self::$instance;
    }

    /**
     * Create (insert) a single aggregate root on the remote server.
     *  Created object will be returned with its identity
     * and all calculated properties evaluated.
     *
     * @param AggregateRoot $aggregate
     * @return AggregateRoot Persisted aggregate root
     */
    public function create(AggregateRoot $aggregate)
    {
        $class = get_class($aggregate);
        $name = Name::full($class);
        $response =
            $this->http->sendRequest(
                self::CRUD_URI.'/'.rawurlencode($name),
                'POST',
                $aggregate->toJson(),
                array(201));
        return RestHttp::parseResult($response, $class);
    }

    /**
     * Modify existing aggregate root on the remote server.
     * Aggregate root will be saved and all calculated properties evaluated.
     *
     * @param AggregateRoot $aggregate
     * @return AggregateRoot Persisted aggregate root
     */
    public function update(AggregateRoot $aggregate)
    {
        $class = get_class($aggregate);
        $name = Name::full($class);
        $response =
            $this->http->sendRequest(
                self::CRUD_URI.'/'.rawurlencode($name).'?uri='.rawurlencode($aggregate->getURI()),
                'PUT',
                $aggregate->toJson(),
                array(200));
        Repository::instance()->invalidate($class, $aggregate->URI);
        return RestHttp::parseResult($response, $class);
    }

    /**
     * Delete existing aggregate root from the remote server.
     * If possible, aggregate root will be deleted and it's instance
     * will be provided.
     *
     * @param string $class
     * @param string $uri
     * @return AggregateRoot Deleted aggregate root
     */
    public function delete($class, $uri)
    {
        $name = Name::full($class);
        $response =
            $this->http->sendRequest(
                self::CRUD_URI.'/'.rawurlencode($name).'?uri='.rawurlencode($uri),
                'DELETE',
                null,
                array(200));
        Repository::instance()->invalidate($class, $uri);
        return RestHttp::parseResult($response, $class);
    }

    /**
     * Get domain object from remote server using provided identity.
     * If domain object is not found an exception will be thrown.
     *
     * @param string $class
     * @param string $uri
     * @return AggregateRoot Fetched aggregate root
     */
    public function read($class, $uri)
    {
        $name = Name::full($class);
        $response =
            $this->http->sendRequest(
                self::CRUD_URI.'/'.rawurlencode($name).'?uri='.rawurlencode($uri),
                'GET',
                null,
                array(200));
        return RestHttp::parseResult($response, $class);
    }
}
