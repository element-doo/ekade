package com.emajliramokade
package email.services
package abstracts

import api.model.EmailProvjera.{ Odgovor, Zahtjev }
import hr.ngs.patterns.ISerialization
import scala.concurrent.Future

abstract class RemoteEmailValidator(
    serialization: ISerialization[String]) extends interfaces.EmailValidator with RemotingDispatch {
  def serviceUrl: String

  def validate(zahtjev: Zahtjev): Future[Odgovor] =
    sendZahtjev(zahtjev)


  def sendZahtjev(zahtjev: Zahtjev): Future[Odgovor] = {
    val reqStr  = serialization.serialize(zahtjev)
    val reqBody = reqStr.getBytes

    send(reqBody) map { resBody =>
      val resStr = new String(resBody, "UTF-8")
      serialization.deserialize[Odgovor](resStr, null)
    }
  }
}
