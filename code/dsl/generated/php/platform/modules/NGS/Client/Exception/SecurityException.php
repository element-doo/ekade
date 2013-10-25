<?php
namespace NGS\Client\Exception;

require_once(__DIR__.'/ClientErrorException.php');

class SecurityException extends ClientErrorException
{
    function __construct($response)
    {
        $this->message = $response;
    }
}
