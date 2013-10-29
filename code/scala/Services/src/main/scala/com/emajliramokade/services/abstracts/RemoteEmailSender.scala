package com.emajliramokade
package services
package abstracts

import api.model.EmailProvjera.Odgovor
import email.Email
import scala.concurrent.Future
import scala.xml.PrettyPrinter

private object RemoteEmailSender

trait RemoteEmailSender
    extends interfaces.EmailSender { this: Remoting [Email]=>

  //val prettyPrinter = new PrettyPrinter(200, 2)

  def send(email: Email): Future[Odgovor] = Future {
    val bodyStr =
      RemoteEmailSender synchronized { // FFS
        val bodyXml = email.toXml
        bodyXml.toString
      }

//    val bodyStr = prettyPrinter.format(bodyXml)

    val serviceUrl = serviceUrlFactory(email)
    val body = bodyStr.toUTF8
    val response = send(serviceUrl, body)

    import scala.concurrent.Await
    import scala.concurrent.duration._
    val res = Await.result(response, 30.seconds)

    println("RESPONSE OD RABBITA")
    println(new String(res, "UTF-8"))

    // Od responsa napraviti Odgovor, i vratiti
    new Odgovor
  }
}
