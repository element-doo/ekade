RUSTC=rust-0.8/x86_64-unknown-linux-gnu/stage2/bin/rustc

all: server client

zmq: rust-zmq/lib.rs
	${RUSTC} rust-zmq/lib.rs

server: kade_server.rs zmq
	${RUSTC} -L rust-zmq kade_server.rs

client: kade_client.rs zmq
	${RUSTC} -L rust-zmq kade_client.rs

clean:
	rm -f kade_server kade_client rust-zmq/libzmq*.so
