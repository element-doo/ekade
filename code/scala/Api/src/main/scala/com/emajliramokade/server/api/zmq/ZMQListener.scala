package com.emajliramokade
package server.api
package zmq

import org.jeromq.{ ZContext, ZMQ, ZMQException }
import org.slf4j.Logger

class ZMQListener(
    logger: Logger
  ) extends Combinators {

  val frontend_addr = "tcp://144.76.184.25:10011"
  val n_listeners   = 100

  logger.info("Booting up ZMQ Listener ...")

  val mq = new ZContext(1)
  val threads = (0 to n_listeners) map (n => spawn_thread { listen(mq) })

  def listen(mq: ZContext) {
    val sock = mq createSocket ZMQ.REP
    sock connect frontend_addr

    forever {
      val msg     = sock.recv
      val zahtjev = com.emajliramokade.email.proto.EmailProvjera.Zahtjev.parseFrom(msg)

      logger.debug("[" + java.lang.Thread.currentThread + "] -> " + zahtjev)
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
