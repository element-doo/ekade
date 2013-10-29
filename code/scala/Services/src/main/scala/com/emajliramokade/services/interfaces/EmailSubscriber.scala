package com.emajliramokade
package services
package interfaces

import api.model.EmailRegistracija.{ Odgovor, Zahtjev }

import scala.concurrent.Future

trait EmailSubscriber {
  def subscribe(zahtjev: Zahtjev): Future[Odgovor]
}
