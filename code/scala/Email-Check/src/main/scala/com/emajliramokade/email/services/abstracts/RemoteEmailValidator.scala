package com.emajliramokade
package email.services
package abstracts

import api.model.EmailProvjera.{ Odgovor, Zahtjev }

import scala.concurrent.Future

trait RemoteEmailValidator
    extends Serializator
    with    interfaces.EmailValidator { this: Remoting =>

  def validate(zahtjev: Zahtjev): Future[Odgovor] =
    sendZahtjev(zahtjev)

  def sendZahtjev(zahtjev: Zahtjev): Future[Odgovor] = {
    val reqStr  = serialization.serialize(zahtjev)
    val reqBody = reqStr.getBytes

    send(reqBody) map { resBody =>
      val resStr = resBody.fromUTF8
      serialization.deserialize[Odgovor](resStr, null)
    }
  }
}
