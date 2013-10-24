package com.emajliramokade
package services
package interfaces

import api.model.ImageSave.{ Odgovor, Zahtjev }

import scala.concurrent.Future

trait ImageSaver {
  def save(zahtjev: Zahtjev): Future[Odgovor]
}
