package com.emajliramokade
package services

import org.zeromq.ZMQ
import scala.concurrent.Future

trait RemotingZeroMQ[T] extends Remoting[T] {
  def send(
      serviceUrl: String
    , request: Array[Byte]
    , headers: Map[String, String] = Map.empty
    ): Future[Array[Byte]] =

    Future {
      val socket = new ZeroSocket(serviceUrl)
      socket.send(request)
      val response = socket.receive()
      socket.close()
      response
    }

  private object ZeroSocket {
    val context = ZMQ.context(1)
  }

  private class ZeroSocket(url: String) {
    import ZeroSocket._

    val socket = context.socket(ZMQ.REQ)
    socket.connect(url)

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
