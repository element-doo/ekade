package com.emajliramokade
package services
package interfaces

import api.model.ImageLoad.{ Odgovor, Zahtjev }

import scala.concurrent.Future

sealed trait TipSlike {
  override val toString =
    getClass.getSimpleName
      .replaceFirst("\\$$", "")
      .toLowerCase
}

object TipSlike {
  case object Thumbnail extends TipSlike
  case object Web extends TipSlike
  case object Email extends TipSlike
  case object Original extends TipSlike
}

trait ImageLoader {
  def load(zahtjev: Zahtjev): Future[Odgovor]
}
