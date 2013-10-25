<?php
namespace NGS\Client;

require_once(__DIR__.'/../Utils.php');
require_once(__DIR__.'/../Name.php');

require_once(__DIR__.'/HttpRequest.php');
require_once(__DIR__.'/Exception/InvalidRequestException.php');
require_once(__DIR__.'/Exception/NotFoundException.php');
require_once(__DIR__.'/Exception/RequestException.php');
require_once(__DIR__.'/Exception/SecurityException.php');
require_once(__DIR__.'/Exception/ClientErrorException.php');
require_once(__DIR__.'/Exception/ServerErrorException.php');
require_once(__DIR__.'/../Converter/PrimitiveConverter.php');
require_once(__DIR__.'/../Converter/ObjectConverter.php');
require_once(__DIR__.'/QueryString.php');

use NGS\Client\Exception\InvalidRequestException;
use NGS\Client\Exception\NotFoundException;
use NGS\Client\Exception\RequestException;
use NGS\Client\Exception\SecurityException;
use NGS\Client\Exception\ServerErrorException;
use NGS\Client\Exception\ClientErrorException;
use NGS\Converter\PrimitiveConverter;
use NGS\Converter\ObjectConverter;

/**
 * HTTP client used communication with platform
 * Should not be used directly, instead use domain patterns
 * Requests can be monitored via {@see addSubscriber}
 */
class RestHttp
{
    const EVENT_REQUEST_BEFORE    = 'request.before';
    const EVENT_REQUEST_SENT      = 'request.sent';
    const EVENT_REQUEST_ERROR     = 'request.error';

    protected $subscribers = array();

    /**
     * @var string
     */
    protected $service;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string Authentication string
     */
    protected $auth;
    protected $certPath;

    /**
     * @var array
     */
    protected $lastResponse;

    /**
     * @var RestHttp Singleton instance
     */
    protected static $instance;

    /**
     * Creates new client instance
     *
     * @param string $service Service base url
     * @param string $username
     * @param string $password
     */
    public function __construct($service, $username=null, $password=null)
    {
        $this->service = $service;
        if ($username!==null && $password!==null) {
            $this->setAuth($username, $password);
        }
    }

    /**
     * Set username/password used for http authentication
     *
     * @param string $username
     * @param string $password
     */
    public function setAuth($username, $password)
    {
        $this->username = $username;
        $this->auth = 'Basic '.base64_encode($username.':'.$password);
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setCertificate($certPath) {
        $this->certPath = $certPath;
    }

    /**
     * Gets or sets singleton instance of rest Http
     *
     * @param RestHttp
     * @return RestHttp
     */
    public static function instance(RestHttp $http = null)
    {
        if($http === null)
            return self::$instance;
        self::$instance = $http;
    }

    /**
     * Sends http request
     *
     * @param string $uriSegment   Appended to REST service uri
     * @param string $method       HTTP method
     * @param null   $body         Request body
     * @param array  $expectedCode Expected http codes, throw exception
     * @param string $accept
     * @throws Exception\InvalidRequestException|Exception\NotFoundException|Exception\RequestException|Exception\SecurityException
     * @throws Exception\RequestException
     * @internal param array $headers
     * @return mixed
     */
    public function sendRequest(
        $uriSegment,
        $method = 'GET',
        $body = null,
        array $expectedCode = null,
        $accept = 'application/json')
    {
        $options = array();
        if (isset($this->certPath)) {
            $options[CURLOPT_CAINFO] = $this->certPath;
        }

        $request = new HttpRequest($this->service.$uriSegment, $method, null, null, $options);

        $requestHeaders = array(
            'Accept: '.$accept,
            'Content-type: application/json',
            'Authorization: '.$this->auth,
            //'Content-length: 0'
        );
        if (($method==='PUT' || $method==='POST') && ($body===null || strlen($body)===0)){
            $requestHeaders[] = 'Content-length: 0';
        }

        $request->headers($requestHeaders);

        if($body !== null)
            $request->body($body);

        if ($this->hasSubscribers())
            $this->dispatch(self::EVENT_REQUEST_BEFORE, array(
                'request' => $request,
            ));

        $response = $request->send();

        $responseHeaders = $request->getResponseHeaders();
        $this->lastResponse = array(
            'info' => $responseHeaders,
            'body' => $response
        );

        // no response received from server or curl errored out
        if($response === null && $this->hasSubscribers()) {
            $this->dispatch(self::EVENT_REQUEST_ERROR, array(
                'error' => $request->getError()
            ));
            $ex = new RequestException('Failed to send request. '.$request->getError());
            $ex->setRequest($request);
            throw $ex;
        }
        $httpCode = $request->getResponseCode();
        $contentType = $request->getResponseContentType();

        if ($this->hasSubscribers())
            $this->dispatch(self::EVENT_REQUEST_SENT, array(
                'request' => $request,
                'response' => array(
                    'body' => $response,
                    'code' => $httpCode,
                ),
                'curl_info' => $request->getResponseInfo(),
            ));

        if($expectedCode !== null && !in_array($httpCode, $expectedCode)) {
            switch($contentType) {
                case 'application/json':
                    $response = json_decode($response);
                    break;
                case 'text/xml':
                    $xml = new \SimpleXmlIterator($response);
                    $response = (string) $xml;
                    break;
            }
            $message = trim($response);
            if ($message==='') {
                $message = 'Unexpected http code. Response body was empty. ';
            }
            if ($curlError = $request->getError()) {
                $message .= 'Curl error: '.$curlError;
            }

            $ex = false;
            switch($httpCode) {
                case 400:
                    $ex = new InvalidRequestException($message, $httpCode);
                    break;
                case 401:
                case 403:
                    $ex = new SecurityException($message, $httpCode);
                    break;
                case 404:
                    $ex = new NotFoundException($message, $httpCode);
                    break;
                case 413:
                   $ex = new RequestException('Request body was too large. '.$message, $httpCode);
                   break;
                default:
                    if($httpCode < 300) {
                        $ex = new RequestException('Unexpected http code '.$httpCode.'. '.$message);
                    }
                    if ($httpCode>=400 && $httpCode < 500) {
                        $ex = new ClientErrorException($message, $httpCode);
                    }
                    if ($httpCode>=500 && $httpCode < 600) {
                        $ex = new ServerErrorException($message, $httpCode);
                    }
                    $ex = new RequestException($message, $httpCode);
                break;
            }
            $ex->setRequest($request);
            throw $ex;
        } else {
            return $response;
        }
    }

    public static function parseResult($response, $class = null)
    {
        $data = json_decode($response, true);
        if($class !== null && is_array($data)) {
            $converter = ObjectConverter::getConverter($class);
            return $converter::fromJson($response);
        }
        return $data;
    }

    public function getLastResult()
    {
        return $this->lastResponse;
    }

    /**
     * Subscribe a callable to listen to HTTP request events
     *
     * Example use for simple logging:<br>
     * <code>
     * $http = RestHttp::instance();
     * $http->addSubscriber(function($event, $context) {
     *     if ($event === RestHttp::EVENT_REQUEST_SENT) {
     *         echo 'request sent';
     *         print_r($context);
     *     }
     * });
     * </code>
     *
     * @param callable $subscriber
     * @throws \InvalidArgumentException
     */
    public function addSubscriber($subscriber)
    {
        if (!is_callable($subscriber)) {
            throw new \InvalidArgumentException('Subscriber must be callable type!');
        }
        $this->subscribers[] = $subscriber;
    }

    /**
     * Dispatches event to all subscribed listeners
     *
     * @param       $event
     * @param array $context
     */
    protected function dispatch($event, array $context)
    {
        array_map(
            function($subscriber) use ($event, $context) {
                call_user_func_array($subscriber, array($event, $context));
            },
            $this->subscribers);
    }

    private function hasSubscribers()
    {
        return !empty($this->subscribers);
    }
}
