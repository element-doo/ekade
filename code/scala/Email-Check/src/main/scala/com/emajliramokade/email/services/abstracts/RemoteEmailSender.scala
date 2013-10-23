package com.emajliramokade
package email.services
package abstracts

import api.model.EmailProvjera.Odgovor
import email.Email
import scala.concurrent.Future
import scala.xml.PrettyPrinter

trait RemoteEmailSender
    extends interfaces.EmailSender { this: Remoting =>

  val prettyPrinter = new PrettyPrinter(200, 2)

  def send(email: Email): Future[Odgovor] = {
    val bodyXml = email.toXml
    val bodyStr = prettyPrinter.format(bodyXml)
    val body = bodyStr.getBytes("UTF-8")

    val response = send(body)
    // Od responsa napraviti Odgovor, i vratiti
    ???
  }
}
