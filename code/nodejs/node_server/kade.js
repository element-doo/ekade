/**
 * node.js message server implementation
 *
 * @package         emajliramo_kade_nodejs
 * @category        node
 * @author          Matija Loncar
 */
var zmq      = require('zmq');
var frontend = require('./frontend_server.js');
var config   = require('./config.js');

// *** ZMQ backend *** //
try
{
    var Req = zmq.socket('pull');
    Req.bindSync(config.ZMQ_LISTEN_ON);

    Req.on('message',function(data)
    {
        try
        {
            var parsed = JSON.parse( data.toString() );

            if(parsed && parsed.message)
            {
                frontend.publish();
            }
        }
        catch(ex)
        {
            console.log('Invalid data received', data);
        }
    });
}
catch ( e )
{
    console.log( 'Could not start up ZMQ', e );
}

console.log('** file executed **');
