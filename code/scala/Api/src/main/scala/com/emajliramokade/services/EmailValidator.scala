package com.emajliramokade.services

import com.emajliramokade.api.model.Api.Odgovor
import scala.concurrent.Future
import com.emajliramokade.api.model.Api.Zahtjev

trait EmailValidator {
  def validate(zahtjev: Zahtjev): Future[Odgovor]
}
