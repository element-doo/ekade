<?php
namespace NGS\Client\Exception;

require_once(__DIR__.'/RequestException.php');

/**
 * Exception thrown for 5xx http status codes
 */
class ServerErrorException extends RequestException
{

}
