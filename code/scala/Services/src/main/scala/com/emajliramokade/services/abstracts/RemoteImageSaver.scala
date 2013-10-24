package com.emajliramokade
package services
package abstracts

import api.model.ImageSave.{ Odgovor, Zahtjev }

import scala.concurrent.Future

trait RemoteImageSaver
    extends Serializator
    with    interfaces.ImageSaver { this: Remoting[Zahtjev] =>

  def save(zahtjev: Zahtjev): Future[Odgovor] = {
    val reqStr  = serialization.serialize(zahtjev)

    val serviceUrl = serviceUrlFactory(zahtjev)
    val reqBody = reqStr.getBytes
    send(serviceUrl, reqBody) map { resBody =>
      // Response body is empty
      new Odgovor()
    }
  }
}
