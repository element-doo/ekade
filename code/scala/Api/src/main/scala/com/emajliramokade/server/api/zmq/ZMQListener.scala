package com.emajliramokade
package server.api
package zmq

import org.jeromq.{ ZContext, ZMQ, ZMQException }
import org.slf4j.Logger
import io.jvm.uuid._
import services.dispatchers.EmailSenderDispatcher

class ZMQListener(
    logger: Logger
  , dispatcher: EmailSenderDispatcher
  ) extends Combinators {

  import scala.concurrent.Await
  import scala.concurrent.duration._

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

      val email = zahtjev.getEmail
      val kadaID = if (zahtjev.hasKadaID) UUID(zahtjev.getKadaID) else null

      val zahtjevApi = new com.emajliramokade.api.model.EmailProvjera.Zahtjev()
        .setEmail(email)
        .setKadaID(kadaID)

      val resFut = dispatcher.dispatch(zahtjevApi)
      val res = Await.result(resFut, 60 seconds)

      logger.debug("[" + java.lang.Thread.currentThread + "] -> " + zahtjev)

      val builder = com.emajliramokade.email.proto.EmailProvjera.Odgovor.newBuilder
      builder setStatus res.getStatus
      builder setPoruka res.getPoruka

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
