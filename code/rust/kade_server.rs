extern mod zmq;

use std::os;

mod kade_dns;

fn main() {
  let args = os::args();
  if args.len() < 2 {
    println(fmt!("Usage: %s zmq_addr", args[0]));
    os::set_exit_status(1);
    return;
  }

  let ctx = zmq::Context::new();
  let responder = ctx.socket(zmq::REP).unwrap();
  assert!(responder.bind(args[1]).is_ok());

  let mut msg = zmq::Message::new();
  let mut cur_idx = 0;
  loop {
    responder.recv(&mut msg, 0);
    responder.send_str(
      do msg.with_str |domain| {
        println(fmt!("%d: %s", cur_idx, domain));
        cur_idx += 1;
        match kade_dns::mx_ping(domain) {
          Err(()) => { "ERR" }
          Ok(None) => { "NO" }
          Ok(Some(_)) => { "YES" }
        }
      },
      0);
  }
}
