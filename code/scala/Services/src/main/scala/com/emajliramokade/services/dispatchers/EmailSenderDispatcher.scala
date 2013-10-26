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
import org.apache.commons.io.IOUtils
import abstracts.RemoteImageLoader
import com.emajliramokade.services.interfaces.TipSlike
import scala.concurrent.Await
import scala.concurrent.duration._
import abstracts.RemoteEmailSubscriber
import org.apache.commons.io.FileUtils
import scala.concurrent.Promise
import com.emajliramokade.services.impl.PlatformRemoteEmailSender

class EmailSenderDispatcher(
    logger: org.slf4j.Logger
  , emailSender: EmailSender
  , validator: EmailValidatorDispatcher
  , imageLoader: RemoteImageLoader
  , emailSubscriber: RemoteEmailSubscriber
  , platformEmailSender: PlatformRemoteEmailSender) {

  case class Resource(filename: String) {
    val bytes = IOUtils.toByteArray(
      getClass.getResourceAsStream("/" + filename)
    )

    lazy val string = new String(bytes, "UTF-8")

    def withText(replacements: (String, String)*) =
      replacements.foldLeft(string){ case (str, (src, dst)) =>
        str.replace(src, dst)
      }
  }

  private val logo         = Resource("logo.png")
  private val templateText = Resource("template.txt")
  private val templateHtml = Resource("template.html")

  private def checkRegistration(zahtjev: Zahtjev) = {
    val registracijaZahtjev =
      new api.model.EmailRegistracija.Zahtjev()
        .setEmail(zahtjev.getEmail)

    val registracijaProces =
      emailSubscriber.subscribe(registracijaZahtjev)

    val odgovor = Promise[Odgovor]

    registracijaProces onComplete {
      case Success(registracija) if registracija.getOdjavljen =>
        logger.trace("Registracija (odjavljen):" + registracija)

        odgovor.success(
          new Odgovor()
            .setStatus(false)
            .setPoruka("Ovaj mail je odjavljen!")
        )

      case Success(registracija) =>
        logger.trace("Registracija:" + registracija)
        odgovor.success(sendMail(zahtjev, registracija.getUnsubscribeID))

      case Failure(f) =>
        odgovor.failure(f)
    }

    odgovor.future
  }

  private def sendMail(zahtjev: Zahtjev, odjavaID: String): Odgovor = {
    val slikaZahtjev =
      new api.model.ImageLoad.Zahtjev()
        .setKadaID(zahtjev.getKadaID)
        .setTipSlike(TipSlike.Email.toString)

    val slika =
      Await.result(
        imageLoader.load(slikaZahtjev)
      , 10.seconds
      )

    logger.trace("Slika: " + slika)

    val kadaID = zahtjev.getKadaID.toString
    val kada = slika.getPodaciSlike.getFilename

    val text =
      templateText.withText(
        "${kadaID}" -> kadaID
      , "${filename}" -> kada
      , "${odjavaID}" -> odjavaID
      )

    val html =
      templateHtml.withText(
        "${filename}" -> kada
      , "${odjavaID}" -> odjavaID
      )

    val email = (
      Email(
        From("majstor@emajliramokade.com")
      , To(zahtjev.getEmail)
      , Subject("Vaša kada je stigla!")
      )
      setTextBody(text)
      setHtmlBody(html)
      addAttachment(logo.filename, logo.bytes)
      addAttachment(slika.getPodaciSlike.getFilename, slika.getBody)
    )

    // emailSender send email
    platformEmailSender send email

    new Odgovor()
      .setStatus(true)
      .setPoruka("Kada je emajlirana!")
  }

  def dispatch(zahtjev: Zahtjev) =
    validator.dispatch(zahtjev) flatMap { odgovor =>
      // TAKO JE! USPOREBA BOOLEANA SA TRUE!
      // ALI JE CITLJIVIJE 200%
      if (odgovor.getStatus == true) {
        checkRegistration(zahtjev)
      }
      else {
        Promise.successful(odgovor).future
      }
    }
}
