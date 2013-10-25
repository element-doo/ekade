<?php
namespace NGS\Client\Exception;

use NGS\Client\HttpRequest;

/**
 * Generic http exception used for all request exceptions
 */
class RequestException extends \Exception
{
    protected $request;

    public function setRequest(HttpRequest $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }
}
