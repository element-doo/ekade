package com.emajliramokade
package email.services
package impl

import api.model.EmailProvjera.{ Odgovor, Zahtjev }

import hr.ngs.patterns.ISerialization
import scala.concurrent.Future

class RustRemoteEmailValidator(
    val serialization: ISerialization[String])
    extends abstracts.RemoteEmailValidator
    with    RemotingZeroMQ {
  val serviceUrl = "tcp://emajliramokade.com:10090"

  // Overrides RemoteEmailValidator's JSON serialization, and rolls its own.
  override def validate(zahtjev: Zahtjev): Future[Odgovor] = {
    zahtjev.getEmail.split('@') toList match {
      case path :: domain :: Nil =>
        val body = domain.getBytes("UTF-8")
        send(body) map { responseBody =>
          val response = new String(responseBody, "UTF-8")
          response match {
            case "YES" => new Odgovor().setStatus(true).setPoruka("Email domena postoji")
            case "NO"  => new Odgovor().setStatus(false).setPoruka("Email domena ne postoji")
            case "ERR" => new Odgovor().setStatus(false).setPoruka("Došlo je do greške prilikom provjere email domene")
            case x     => new Odgovor().setStatus(false).setPoruka(s"Nepoznati odgovor ($x)")
          }
        }
      case _ =>
        Future {
          new Odgovor().setStatus(false).setPoruka("""Email ne sadrži jedan i samo jedan "@" znak""")
        }
    }
  }
}
