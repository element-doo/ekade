all: server client

zmq: rust-zmq/lib.rs
	rustc rust-zmq/lib.rs

server: kade_server.rs zmq
	rustc -L rust-zmq kade_server.rs

client: kade_client.rs zmq
	rustc -L rust-zmq kade_client.rs

clean:
	rm -f kade_server kade_client rust-zmq/libzmq*.so
