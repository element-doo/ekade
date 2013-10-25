package com.emajliramokade
package services
package abstracts

import image.proto.ImageProvjera.{ Odgovor, Zahtjev }

import scala.concurrent.Future

trait RemoteImageVerifier
    extends interfaces.ImageVerifier { this: Remoting[Zahtjev] =>

  def verify(zahtjev: Zahtjev): Future[Odgovor] = {
    val serviceUrl = serviceUrlFactory(zahtjev)
    val body = zahtjev.toByteArray()
    val responseFut = send(serviceUrl, body)
    responseFut map Odgovor.parseFrom
  }
}
