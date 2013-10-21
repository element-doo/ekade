package com.emajliramokade
package services
package impl

import com.emajliramokade.api.model.Api.Odgovor
import scala.concurrent.Future
import hr.ngs.patterns.ISerialization
import com.emajliramokade.services.EmailValidator
import com.emajliramokade.server.api.Locator
import dispatch._

abstract class RemoteEmailValidator(
    serialization: ISerialization[String]) extends EmailValidator {
  def serviceUrl: String

  def validate(email: String): Future[Odgovor] = {
    Http(url(serviceUrl)) map { response =>
      val body = response.getResponseBody("UTF-8")
      serialization.deserialize[Odgovor](body, Locator)
    }
  }
}
