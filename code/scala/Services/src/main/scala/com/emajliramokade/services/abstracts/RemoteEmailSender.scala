package com.emajliramokade
package services
package abstracts

import api.model.EmailProvjera.Odgovor
import email.Email
import scala.concurrent.Future
import scala.xml.PrettyPrinter

trait RemoteEmailSender
    extends interfaces.EmailSender { this: Remoting [Email]=>

  val prettyPrinter = new PrettyPrinter(200, 2)

  def send(email: Email): Future[Odgovor] = {
    val bodyXml = email.toXml
    val bodyStr = prettyPrinter.format(bodyXml)

    val serviceUrl = serviceUrlFactory(email)
    val body = bodyStr.toUTF8
    val response = send(serviceUrl, body)
    // Od responsa napraviti Odgovor, i vratiti
    ???
  }
}
