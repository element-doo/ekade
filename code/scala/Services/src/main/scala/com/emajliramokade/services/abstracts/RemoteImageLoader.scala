package com.emajliramokade
package services
package abstracts

import api.model.ImageLoad.{ Odgovor, Zahtjev }

import com.emajliramokade.services.interfaces.TipSlike
import com.emajliramokade.api.model.Resursi.PodaciSlike

import scala.concurrent.Await
import scala.concurrent.Future
import scala.concurrent.duration._

trait RemoteImageLoader
    extends Serializator
    with    interfaces.ImageLoader { this: Remoting[Zahtjev] =>

  protected def getPodaciSlike(zahtjev: Zahtjev): Future[PodaciSlike]

  def load(zahtjev: Zahtjev): Future[Odgovor] = {
    val reqStr  = serialization.serialize(zahtjev)

    val podaciRequest = getPodaciSlike(zahtjev)

    val serviceUrl = serviceUrlFactory(zahtjev)
    val reqBody = reqStr.getBytes

    send(serviceUrl, reqBody) map { resBody =>
      val slika = Await.result(
        podaciRequest, 10.seconds
      )

      new Odgovor()
        .setPodaciSlike(slika)
        .setBody(resBody)
    }
  }
}
