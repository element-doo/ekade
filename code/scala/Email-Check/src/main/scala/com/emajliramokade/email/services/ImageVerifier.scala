package com.emajliramokade
package email.services

import image.proto.ImageProvjera.{ Odgovor, Zahtjev }

import scala.concurrent.Future

trait ImageVerifier {
  def verify(zahtjev: Zahtjev): Future[Odgovor]
}
