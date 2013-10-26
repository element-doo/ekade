package com.emajliramokade
package services
package dispatchers

import api.model.EmailProvjera.{ Odgovor, Zahtjev }
import interfaces.EmailSender

import scala.util._
import scala.concurrent.Future
import scala.concurrent.Await
import scala.concurrent.duration._

import email._

class EmailSenderDispatcher(
    logger: org.slf4j.Logger
  , esList: Array[EmailSender]
  , validator: EmailValidatorDispatcher) {

  private def sendMail(zahtjev: Zahtjev) = {
    val email = Email(
      From("majstor@emajliramokade.com")
    , To(zahtjev.getEmail)
    , Subject("Vaša kada je stigla!")
    )

    for (sender <- esList.headOption) {
      logger.info("About to send email: {}" + email)
      sender send email
    }
  }

  def dispatch(zahtjev: Zahtjev) =
    validator.dispatch(zahtjev) map { odgovor =>
      // TAKO JE! USPOREBA BOOLEANA SA TRUE!
      // ALI JE CITLJIVIJE 200%
      if (odgovor.getStatus == true) {
        sendMail(zahtjev)
      }

      new Odgovor()
        .setStatus(true)
        .setPoruka("Kada je emajlirana!")
    }
}
