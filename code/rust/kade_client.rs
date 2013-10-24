extern mod zmq;

use std::os;

fn main() {
  let args = os::args();
  if args.len() < 3 {
    println(fmt!("Usage: %s zmq_addr domain", args[0]));
    os::set_exit_status(1);
    return;
  }

  let ctx = zmq::Context::new();
  let requester = ctx.socket(zmq::REQ).unwrap();
  assert!(requester.connect(args[1]).is_ok());

  let mut msg = zmq::Message::new();

  requester.send(args[2].as_bytes(), 0);
  requester.recv(&mut msg, 0).unwrap();
  do msg.with_str |s| {
    println(fmt!("Received: %s", s));
  }
}
