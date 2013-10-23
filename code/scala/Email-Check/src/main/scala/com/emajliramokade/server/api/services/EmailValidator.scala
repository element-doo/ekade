package com.emajliramokade.email.services

import scala.concurrent.Future
import com.emajliramokade.api.model.Api.{Odgovor, Zahtjev}

trait EmailValidator {
  def validate(zahtjev: Zahtjev): Future[Odgovor]
}
