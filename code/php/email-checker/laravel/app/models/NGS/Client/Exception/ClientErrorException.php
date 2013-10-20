<?php
namespace NGS\Client\Exception;

require_once(__DIR__.'/RequestException.php');

/**
 * Exception thrown for 4xx http status codes
 */
class ClientErrorException extends RequestException
{
}
