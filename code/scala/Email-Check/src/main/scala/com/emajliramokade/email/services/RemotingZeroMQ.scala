package com.emajliramokade
package email.services

import org.zeromq.ZMQ
import scala.concurrent.Future

trait RemotingZeroMQ extends Remoting with Service {
  def send(body: Array[Byte]): Future[Array[Byte]] =
    Future {
      val socket = new ZeroSocket()
      socket.send(body)
      val response = socket.receive()
      socket.close()
      response
    }

  private object ZeroSocket {
    val context = ZMQ.context(1)
  }

  private class ZeroSocket() {
    import ZeroSocket._

    val socket = context.socket(ZMQ.REQ)
    socket.connect(serviceUrl)

    def send(body: Array[Byte]) {
      val sendOk = socket.send(body, 0)
      if (!sendOk) {
        throw new Exception("Send failed")
      }
    }

    def receive(): Array[Byte] = {
      socket.recv()
    }

    def close() {
      socket.close()
    }
  }
}
