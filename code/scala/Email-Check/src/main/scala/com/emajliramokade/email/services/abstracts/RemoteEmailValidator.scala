package com.emajliramokade
package email.services
package abstracts

import api.model.EmailProvjera.{ Odgovor, Zahtjev }
import hr.ngs.patterns.ISerialization
import scala.concurrent.Future
import com.emajliramokade.email.services.impl.Remoting

abstract class RemoteEmailValidator(
    val serialization: ISerialization[String]) extends interfaces.EmailValidator with Remoting {
  def serviceUrl: String

  def validate(zahtjev: Zahtjev): Future[Odgovor] =
    sendZahtjev(zahtjev)
}
