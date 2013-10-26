package com.emajliramokade
package services
package impl

import api.model.ImageLoad.Zahtjev
import api.model.Resursi.repositories.SlikeKadeRepository

import interfaces.TipSlike

import hr.ngs.patterns.ISerialization
import scala.concurrent.Future

class GoPlatformImageLoader(
    val serialization: ISerialization[String]
  , slikeKadeRepository: SlikeKadeRepository
  ) extends abstracts.RemoteImageLoader
    with    RemotingDispatch[Zahtjev] {

  val method = "GET"

  def serviceUrlFactory(t: Zahtjev) = {
    val kadaID = t.getKadaID
    val tip = t.getTipSlike
    s"http://static.emajliramokade.com/$tip/$kadaID/kada.jpg"
  }

  protected def getPodaciSlike(zahtjev: Zahtjev) = Future {
    val slikeKade =
      slikeKadeRepository
        .find(zahtjev.getKadaID.toString)
        .get()

    zahtjev.getTipSlike match {
      case TipSlike.Web.toString =>
        slikeKade.getWeb

      case TipSlike.Email.toString =>
        slikeKade.getEmail

      case TipSlike.Original.toString =>
        slikeKade.getOriginal

      case TipSlike.Thumbnail.toString =>
        slikeKade.getThumbnail
    }
  }
}
