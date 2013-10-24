package com.emajliramokade
package server.api
package zmq

import org.jeromq.{ ZContext, ZMQ, ZMQException }

class ZMQListener extends Combinators {

  val frontend_addr = "tcp://127.0.0.1:10011"
  val n_listeners   = 100

  val mq = new ZContext(1)
  val threads = (0 to n_listeners) map (n => spawn_thread { listen(mq) })

  def listen(mq: ZContext) {
    val sock = mq createSocket ZMQ.REP
    sock connect frontend_addr

    forever {
      val msg     = sock.recv
      val zahtjev = com.emajliramokade.email.proto.EmailProvjera.Zahtjev.parseFrom(msg)

      println("[" + java.lang.Thread.currentThread + "] -> " + zahtjev)
      java.lang.Thread.sleep(3000)

      val builder = com.emajliramokade.email.proto.EmailProvjera.Odgovor.newBuilder
      builder setStatus true
      builder setPoruka "Krasan api."
      
      sock send builder.build.toByteArray
    }
  }
}


trait Combinators {

  def forever[A](act: => A) { while(true) { act } }

  def spawn_thread[A](act: => A) = {
    val thread = new java.lang.Thread {
      override def run { act }
    }
    thread.start()
    thread
  }
}
