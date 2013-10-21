package com.emajliramokade.services

import com.emajliramokade.api.model.Api.Odgovor
import scala.concurrent.Future

trait EmailValidator {
  def validate(email: String): Future[Odgovor]
}
