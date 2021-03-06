package com.emajliramokade
package services
package impl

import api.model.EmailProvjera.{ Odgovor, Zahtjev }

import hr.ngs.patterns.ISerialization
import scala.concurrent.Future

class RustRemoteEmailValidator(
    val serialization: ISerialization[String])
    extends abstracts.RemoteEmailValidator
    with    RemotingZeroMQ[Zahtjev] {
  def serviceUrlFactory(t: Zahtjev) = "tcp://emajliramokade.com:10120"

  // Overrides RemoteEmailValidator's JSON serialization, and rolls its own.
  override def validate(zahtjev: Zahtjev): Future[Odgovor] = {
    zahtjev.getEmail.split('@') toList match {
      case path :: domain :: Nil =>
        val serviceUrl = serviceUrlFactory(zahtjev)
        val body = domain.toUTF8
        send(serviceUrl, body) map { responseBody =>
          val response = responseBody.fromUTF8
          response match {
            case "YES" => odgovor(true,  "Email domena postoji")
            case "NO"  => odgovor(false, "Email domena ne postoji")
            case "ERR" => odgovor(false, "Došlo je do greške prilikom provjere email domene")
            case x     => odgovor(false, s"Nepoznati odgovor ($x)")
          }
        }
      case _ =>
        Future {
          odgovor(false, """Email ne sadrži jedan i samo jedan "@" znak""")
        }
    }
  }

  private def odgovor(status: Boolean, poruka: String) =
    new Odgovor().setStatus(status).setPoruka(poruka)
}
