package com.emajliramokade
package services
package abstracts

import api.model.EmailProvjera.{ Odgovor, Zahtjev }

import scala.concurrent.Future

trait RemoteEmailValidator
    extends Serializator
    with    interfaces.EmailValidator { this: Remoting[Zahtjev] =>

  def validate(zahtjev: Zahtjev): Future[Odgovor] =
    sendZahtjev(zahtjev)

  def sendZahtjev(zahtjev: Zahtjev): Future[Odgovor] = {
    val reqStr  = serialization.serialize(zahtjev)

    val serviceUrl = serviceUrlFactory(zahtjev)
    val reqBody = reqStr.getBytes
    val headers = Map("Content-Type" -> "application/json")

    send(serviceUrl, reqBody, headers) map { resBody =>
      val resStr = resBody.fromUTF8
      serialization.deserialize[Odgovor](resStr, null)
    }
  }
}
