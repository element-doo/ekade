RUSTC=rustc

all: server client

zmq: rust-zmq/lib.rs
	${RUSTC} rust-zmq/lib.rs

server: kade_server.rs zmq
	${RUSTC} -L rust-zmq kade_server.rs

client: kade_client.rs zmq
	${RUSTC} -L rust-zmq kade_client.rs

clean:
	rm -f kade_server kade_client rust-zmq/libzmq*.so
