package com.emajliramokade
package email.services
package abstracts

import api.model.EmailProvjera.Odgovor
import email.Email
import com.rabbitmq.client.ConnectionFactory
import scala.concurrent.Future
import scala.xml.PrettyPrinter

abstract class RemoteEmailSender() extends interfaces.EmailSender with RemotingZeroMQ {
  def serviceUrl: String

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
