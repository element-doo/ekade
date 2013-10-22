package com.emajliramokade
package services
package impl

import com.emajliramokade.api.model.Api.Odgovor
import scala.concurrent.Future
import hr.ngs.patterns.ISerialization
import com.emajliramokade.services.EmailValidator
import com.emajliramokade.server.api.Locator
import com.emajliramokade.api.model.Api.Zahtjev

class FakeEmailValidator(
    serialization: ISerialization[String]) extends EmailValidator {
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
