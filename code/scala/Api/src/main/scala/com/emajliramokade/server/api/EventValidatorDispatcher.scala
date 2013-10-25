package com.emajliramokade
package server.api

import api.model.EmailProvjera.{ Odgovor, Zahtjev }
import services.interfaces.EmailValidator

import scala.util._
import scala.concurrent.Future
import scala.concurrent.Await
import scala.concurrent.duration._

class Dispatcher(
    evList: Array[EmailValidator]) {

  def dispatch(zahtjev: Zahtjev) = Future {
    val emailOdgovorRawFutures = evList map { ev =>
      ev.validate(zahtjev)
    }

    val emailOdgovors =
      emailOdgovorRawFutures map { f =>
        Try {
          Await.result(f, 5 seconds)
        } getOrElse(
          new Odgovor()
            .setStatus(true)  // želimo slati mailove čak i ako nemamo provjeru
            .setPoruka("Skršio sam se / timeoutao")
        )
      }

    val successes = emailOdgovors.filter(_.getStatus).size
    val total = emailOdgovors.size

    val status =
      successes.toDouble / total > 0.5

    val poruka =
      if (status)
        "Email je uspješno validiran."
      else
        "Email nije ispravan!"

    new Odgovor()
      .setStatus(status)
      .setPoruka(poruka)
  }
}
