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
    serialization: ISerialization[String]) extends EmailValidator {
  def serviceUrl: String

  def validate(zahtjev: Zahtjev): Future[Odgovor] = {
    val req = url(serviceUrl) << serialization.serialize(zahtjev)

    Http(req) map { response =>
      val body = response.getResponseBody("UTF-8")
      println("RECEIVED: "+ new String(body))
      serialization.deserialize[Odgovor](body, Locator)
    }
  }
}
