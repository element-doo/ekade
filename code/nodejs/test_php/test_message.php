<?php
/**
* test_message.php
* when run, send a test message to nodejs server
*
* @package			emajliramo_kade_nodejs
* @category			PHP
* @author			Matija Loncar
*/

// nodejs server data - should be singled out into config
define('NODEJS_SERVER_URI', '127.0.0.1');
define('NODEJS_SERVER_PORT', '8041');

/**
 * function that sends a message with specified payload to nodejs
 *
 * @param $message
 * @param $payload
 */
function sendNodejsMessage($message, $payload)
{
    $context = new ZMQContext();
    $socket = $context->getSocket( ZMQ::SOCKET_PUSH );
    $socket->connect('tcp://' . NODEJS_SERVER_URI . ':' . NODEJS_SERVER_PORT_BACKEND);

    $data = [
        'message'    => $message,
        'payload'    => $payload
    ];

    $socket->send(json_encode($data));
}

sendNodejsMessage('new_kada', ['id' => rand(1, 100)]);
