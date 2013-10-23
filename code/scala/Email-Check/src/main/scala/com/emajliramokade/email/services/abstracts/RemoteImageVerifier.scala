package com.emajliramokade
package email.services
package abstracts

import image.proto.ImageProvjera.{ Odgovor, Zahtjev }

import scala.concurrent.Future

abstract class RemoteImageVerifier extends interfaces.ImageVerifier with RemotingZeroMQ {
  def serviceUrl: String

  def verify(zahtjev: Zahtjev): Future[Odgovor] = {
    val body = zahtjev.getOriginalnaSlika.toByteArray
    val responseFut = send(body)
    responseFut map Odgovor.parseFrom
  }
}
