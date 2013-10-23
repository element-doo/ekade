package com.emajliramokade
package server.api

import api.model.EmailProvjera.{ Odgovor, Zahtjev }
import services.interfaces.EmailValidator

import scala.concurrent.Future

class Dispatcher(
    evList: Array[EmailValidator]) {

  def dispatch(zahtjev: Zahtjev): Future[Odgovor] = {
    val emailOdgovorRawFuture = evList map { ev =>
      ev.validate(zahtjev)
    } toList

    val emailOdgovorFutureList = Future sequence emailOdgovorRawFuture
    emailOdgovorFutureList map mergeEmailOdgovorList
  }

  private def mergeEmailOdgovorList(emailOdgvorList: List[Odgovor]): Odgovor = {
    def getStatusString(status: Boolean) = if (status) "Uspjeh" else "Neuspjeh"
    val combinedStatus = emailOdgvorList.forall(_.getStatus == true)
    val combinedPoruka = emailOdgvorList
      .map(odgovor => s"${ getStatusString(odgovor.getStatus) }: ${ odgovor.getPoruka }")
      .mkString("\n")

    new Odgovor().setStatus(combinedStatus).setPoruka(combinedPoruka)
  }
}
