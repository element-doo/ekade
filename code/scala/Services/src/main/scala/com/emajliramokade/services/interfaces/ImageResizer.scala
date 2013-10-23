package com.emajliramokade
package services
package interfaces

import api.model.ImageResize.{ ResizeZahtjev, Slika }

import scala.concurrent.Future

trait ImageResizer {
  def resize(
    original: Array[Byte]
  , resizeTargetList: Seq[ResizeZahtjev]
  ): Future[Map[ResizeZahtjev, Slika]]
}
