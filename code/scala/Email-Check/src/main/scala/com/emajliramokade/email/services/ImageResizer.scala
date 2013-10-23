package com.emajliramokade
package email.services

import api.model.ImageResize.{ ResizeZahtjev, Slika }

import scala.concurrent.Future

trait ImageResizer {
  def resize(
    original: Array[Byte]
  , resizeTargetList: Seq[ResizeZahtjev]
  ): Future[Map[ResizeZahtjev, Slika]]
}
