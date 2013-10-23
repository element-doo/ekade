/*
package com.emajliramokade
package comms

import org.jeromq.ZMQ
import org.jeromq.ZMQ.{ Context, Socket }
import akka.actor._
import scala.collection.JavaConverters._
import scala.concurrent.Future
import java.{ util => ju }
import scala.concurrent.ExecutionContext
import scala.util.Success

object ZeroMQTest{
  object RecvLock
  object SendLock

  def main(args : Array[String]) {
    doJava()
  }

  def send (s : ZMQ.Socket, t : Traversable[String]) {
    t.init.foreach(s sendMore _)
    s send t.last
  }

  def recv (s : ZMQ.Socket) : List[String] = {
    val m = s.recvMsg
    (new String(m.data)) :: (
      if (m.header()(1) == 1) recv(s) else Nil
    )
  }

  def doJava() {
    val context = ZMQ.context(1)
    val socket = context.socket(ZMQ.DEALER)
//    val socket = context.socket(ZMQ.REP)
    socket.connect("tcp://10.2.3.1:10011")

    while (!Thread.currentThread ().isInterrupted ()) {
      val poruka = recv(socket)
      println(poruka)
      val envelope :: delimiter :: zahtjev :: Nil = poruka

      obradi(envelope, zahtjev) onComplete {
        case Success(odgovor) =>
          println(s"LOCK INIT: [${ Thread.currentThread() }]: $envelope")
          SendLock synchronized {
            println("LOCK OK:   "+ envelope)
            send(socket, envelope :: delimiter :: odgovor :: Nil)
            println("ODGOVORIO: "+ envelope)
          }
          println("LOCK DONE: "+ envelope)
        case _ =>
          println("NEŠTO JE PUKLO U OBRADI")
      }
    }

    socket.close();
    context.term();
  }

  def obradi(envelope: String, zahtjev: String): Future[String] = Future {
    Thread.sleep(1000)
    s"ODGOVOR OD [$envelope]: $zahtjev"
  }
}
*/

