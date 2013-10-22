package com.emajliramokade
package services
package impl

import com.emajliramokade.api.model.Api.Odgovor
import scala.concurrent.Future
import hr.ngs.patterns.ISerialization
import com.emajliramokade.services.EmailValidator
import com.emajliramokade.server.api.Locator
import dispatch._
import com.emajliramokade.api.model.Api.Zahtjev

abstract class RemoteEmailValidator(
    val serialization: ISerialization[String]) extends EmailValidator with Remoting {
  def serviceUrl: String

  def validate(zahtjev: Zahtjev): Future[Odgovor] =
    sendZahtjev(zahtjev)
}
