var http = require('http');

var fs = require('fs');
var server = http.createServer();

var hostname = '127.0.0.1';

var ports = [
	10040, // scala image uploader
	10071  // php image uploader
];

server.on('request', function(request, response) {
	if (request.method !== 'POST') {
		response.writeHead(400);
		response.end('Invalid request');
		return;
	}

	var clients = [];
	var data = '';
	var cb = handleResponse(request, response, ports.length, data);

	for (var p in ports) {
		var client = http.request({
			hostname: hostname,
			port: ports[p],
			path: '/',
			method: 'POST',
			headers: request.headers
		}, cb);
		client.on('error', cb);
		client.setTimeout(10000, cb);
		clients.push(client);
	}

	request.on('data', function(chunk) {
		for (var i in clients)
			clients[i].write(chunk);

		data += chunk;
	});

	request.on('end', function() {
		for (var i in clients)
			clients[i].end();
	});
});

server.listen(10050, '127.0.0.1');
server.on('error', function(error) { console.log(error.message); });



/*****************************************************************************/



var forwardResponse = function(source, destination) {
	var data = '';
	source.on('data', function(chunk) {
		data += chunk;
	});
	source.on('end', function() {
		destination.writeHead(source.statusCode, source.headers);
		destination.end(data);
	});
}

var dumpRequest = function(request, data) {
	if (data !== null) {
		var mtime = new Date().getTime();
		var filename = request.socket.remoteAddress + mtime;
		filename = new Buffer(filename).toString('base64');

		fs.writeFile('slike/' + filename, data);
	}

	// Feed the GC
	data = null;
}

var handleResponse = function(request, response, clientsLength, data) {
	var counter = 0;

	return function(cresponse) {
		// As soon as one client finishes successfully the job is done
		if (cresponse instanceof http.IncomingMessage && cresponse.statusCode == 200) {
			forwardResponse(cresponse, response);
			return;
		}

		// Something is wrong, but give other clients a chance.
		if (++counter != clientsLength)
			return;

		// Last client failed, dump request to hard disk and report error
		dumpRequest(request, data);

		if (cresponse instanceof http.IncomingMessage) {
			forwardResponse(cresponse, response);
			return;
		}

		if (cresponse == undefined)
			cresponse = 'Operacija je timeoutala.';

		response.writeHead(500);
		response.end(cresponse.message ? cresponse.message : cresponse);
	}
}
