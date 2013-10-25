/*
package com.emajliramokade
package services
package impl

import api.model.EmailProvjera.{ Odgovor, Zahtjev }

import hr.ngs.patterns.ISerialization
import scala.concurrent.Future

class FakeEmailValidator(
    serialization: ISerialization[String]
  ) extends interfaces.EmailValidator {

  def validate(zahtjev: Zahtjev): Future[Odgovor] = {
    Future {
      val email = zahtjev.getEmail
      println(s"VALIDATING [FAKE]: $email")
      if (email.startsWith("a")) {
        new Odgovor().setStatus(false).setPoruka("""Email počinje sa "a", pa očito nevalja""")
      } else {
        new Odgovor().setStatus(true).setPoruka("""Email ne počinje sa "a", pa očito valja""")
      }
    }
  }
}
*/
