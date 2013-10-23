/*
package com.emajliramokade
package dispatcher

import com.emajliramokade.api.model.Api.Zahtjev
import scala.concurrent.Future
import com.emajliramokade.api.model.Api.Odgovor

class Dispatcher(
    evList: Array[services.EmailValidator]) {

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
*/
