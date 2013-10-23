package com.emajliramokade
package email.services
package impl

import api.model.EmailProvjera.{ Odgovor, Zahtjev }

import hr.ngs.patterns.ISerialization
import scala.concurrent.Future

abstract class RemoteEmailValidator(
    val serialization: ISerialization[String]) extends EmailValidator with Remoting {
  def serviceUrl: String

  def validate(zahtjev: Zahtjev): Future[Odgovor] =
    sendZahtjev(zahtjev)
}
