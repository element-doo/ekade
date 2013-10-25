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
		response.writeHead(500);
		response.end('Invalid request');
		return;
	}

	var clients = [ ];
	var data = '';
	var counter = 0;

	var onerror = function(error) {
		if (data !== null) {
			var mtime = new Date().getTime();
			var filename = request.socket.remoteAddress + mtime;
			filename = new Buffer(filename).toString('base64');

			fs.writeFile('slike/' + filename, data);
		}

		data = null;
		if (++counter == clients.length)
			response.end();
	};

	for (var p in ports) {
		var client = http.request({
			hostname: hostname,
			port: ports[p],
			path: '/',
			method: 'POST',
			headers: request.headers
		}, function(cresponse) {
			cresponse.on('data', function(c) {console.log(c.toString()); })
			if (cresponse.statusCode !== 200)
				return onerror(cresponse.statuScode);

			if (++counter == clients.length)
				response.end();
		});
		client.on('error', onerror);
		client.setTimeout(10000, onerror);
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
