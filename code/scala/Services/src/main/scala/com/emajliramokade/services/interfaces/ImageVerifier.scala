package com.emajliramokade
package services
package interfaces

import image.proto.ImageProvjera.{ Odgovor, Zahtjev }

import scala.concurrent.Future

trait ImageVerifier {
  def verify(zahtjev: Zahtjev): Future[Odgovor]
}
