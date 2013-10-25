<?php
namespace NGS\Client;

require_once(__DIR__.'/../Utils.php');
require_once(__DIR__.'/../Name.php');
require_once(__DIR__.'/RestHttp.php');

use NGS\Utils;
use NGS\Name;

/**
 * Proxy service to remote RPC-like API
 *
 * Remote services can be called using their name
 *
 * @package NGS\Client
 */
class ApplicationProxy
{
    const APPLICATION_URI = 'RestApplication.svc';

    protected $http;

    protected static $instance;

    /**
     * Create a new ApplicationProxy instance
     *
     * @param RestHttp $http RestHttp instance used for http request.
     * Optionally specify an instance, otherwise use a singleton instance
     */
    public function __construct(RestHttp $http = null)
    {
        $this->http = $http !== null ? $http : RestHttp::instance();
    }

    /**
     * Gets singleton instance of RestApplication.svc proxy
     *
     * @return ApplicationProxy
     */
    public static function instance()
    {
        if(self::$instance === null)
            self::$instance = new ApplicationProxy();
        return self::$instance;
    }

    /**
     * If remote service doesn't require any arguments it can be called using get method.
     *
     * @param        $command
     * @param array  $expectedCode
     * @param string $accept
     * @return mixed
     */
    public function get($command, array $expectedCode = array(200), $accept = 'application/json')
    {
        return
            $this->http->sendRequest(
                self::APPLICATION_URI.'/'.rawurlencode($command),
                'GET',
                null,
                $expectedCode,
                $accept);
    }

    /**
     * When remote service requires an argument, message with serialized payload will be sent.
     *
     * @param string $command
     * @param array  $data
     * @param array  $expectedCode
     * @param string $accept
     * @return mixed
     */
    public function post(
        $command,
        array $data = null,
        array $expectedCode = array(200),
        $accept = 'application/json')
    {
        return
            $this->postJson(
                $command,
                $data !== null ? json_encode($data) : null,
                $expectedCode,
                $accept
            );
    }

    /**
     * As {@see post}, when arguments are already serialized in JSON
     *
     * @param  string $command
     * @param  string $data         JSON encoded data
     * @param  array  $expectedCode
     * @param  string $accept
     * @return mixed
     */
    public function postJson(
        $command,
        $data = null,
        array $expectedCode = array(200),
        $accept = 'application/json')
    {
        if(!is_string($data) && $data !== null)
            throw new \InvalidArgumentException('Data must be encoded in json string or null. Data was "'.\NGS\Utils\gettype($data).'"');
        return
            $this->http->sendRequest(
                self::APPLICATION_URI.'/'.rawurlencode($command),
                'POST',
                $data,
                $expectedCode,
                $accept);
    }
}
