package com.emajliramokade
package services
package interfaces

import api.model.EmailProvjera.{ Odgovor, Zahtjev }

import scala.concurrent.Future

trait EmailValidator {
  def validate(zahtjev: Zahtjev): Future[Odgovor]
}
