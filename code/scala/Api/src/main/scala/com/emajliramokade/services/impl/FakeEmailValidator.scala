package com.emajliramokade
package services
package impl

import com.emajliramokade.api.model.Api.Odgovor
import scala.concurrent.Future

import hr.ngs.patterns.ISerialization
import com.emajliramokade.services.EmailValidator
//import dispatch
import com.emajliramokade.server.api.Locator

class FakeEmailValidator(
    serialization: ISerialization[String]) extends EmailValidator {
  def validate(email: String): Future[Odgovor] = {
    Future {
      println(s"VALIDATING [FAKE]: $email")
      if (email.startsWith("a")) {
        new Odgovor().setStatus(false).setPoruka("""Email počinje sa "a", pa očito nevalja""")
      } else {
        new Odgovor().setStatus(true).setPoruka("""Email ne počinje sa "a", pa očito valja""")
      }
    }
  }
}
