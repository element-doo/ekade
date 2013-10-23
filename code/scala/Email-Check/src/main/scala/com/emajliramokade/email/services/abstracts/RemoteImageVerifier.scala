package com.emajliramokade
package email.services
package abstracts

import image.proto.ImageProvjera.{ Odgovor, Zahtjev }

import org.zeromq.ZMQ
import scala.concurrent.Future

abstract class RemoteImageVerifier extends interfaces.ImageVerifier {
  def serviceUrl: String
  def context: ZMQ.Context

  def send(s: ZMQ.Socket, body: Array[Byte]) {
    val sendOk = s.send(body, 0)
    if (!sendOk) {
      throw new Exception("Send failed")
    }
  }

  def recv(s: ZMQ.Socket): Array[Byte] = {
    s.recv()
  }

  def verify(zahtjev: Zahtjev): Future[Odgovor] =
    Future {
      val body = zahtjev.getOriginalnaSlika.toByteArray
      val socket = context.socket(ZMQ.REP)
      socket.connect(serviceUrl)
      send(socket, body)
      val response = recv(socket)
      Odgovor.parseFrom(response)
    }
}
