package com.emajliramokade
package services
package impl

import com.emajliramokade.api.model.Api.Odgovor
import hr.ngs.patterns.ISerialization
import com.emajliramokade.services.EmailValidator
import dispatch._
import com.emajliramokade.server.api.Locator

abstract class RemoteEmailValidator(
    serialization: ISerialization[String]) extends EmailValidator {
  def serviceURL: String

  def validate(email: String): Future[Odgovor] = {
    Http(url(serviceURL)) map { response =>
      val body = response.getResponseBody("UTF-8")
      serialization.deserialize[Odgovor](body, Locator)
    }
  }
}
