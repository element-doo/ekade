/**
* frontend server that accepts the socket connections
 *
 * @package         emajliramo_kade_nodejs
 * @category        node
 * @author          Matija Loncar
*/

var http = require('http');
var io   = require('socket.io');
var url  = require('url');
var _    = require('underscore');

var config   = require('./config.js');

// *** frontend server start *** //
var app_client = http.createServer();

// starting a HTTP server for testing
app_client.listen(config.FRONTEND_PORT);

// testing output
app_client.on('request', function(request, response)
{
    console.log('client request');

    response.writeHead(200);
    response.end('socket server is alive and kicking, ready to receive clients.');
});

// *** sockets setup *** //

// keep track of connected clients
var connected_clients = {};

// *** sockets setup *** //

// setup a socket listener on specified server
var socket_client = io.listen(app_client);

// when a socket connection is established
socket_client.sockets.on('connection', function(socket)
{
    // add the client to list
    add_socket_client(socket);
});


// adding a new socket client
function add_socket_client(socket)
{
    // add socket to list of connected clients
    connected_clients[socket.id] = socket;

    // register disconnect - using closure to capture socket.id
    var disconnect_handler = (function(socket_id)
    {
        return function()
        {
            remove_socket_client(socket_id);
        };

    })(socket.id);

    // register disconnect
    socket.on('disconnect', disconnect_handler);

    socket.emit('new_kada', {id: 5});
}

// removing a socket client
function remove_socket_client(socket_id)
{
    delete connected_clients[socket_id];
}

// exporting functionality
exports = {
    publish: function(message, data)
    {
        _.each(connected_clients, function(socket)
        {
            socket.emit(message, data);
        })
    }
};
