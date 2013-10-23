package com.emajliramokade
package email.services
package abstracts

import api.model.EmailProvjera.Odgovor
import email.Email
import com.rabbitmq.client.ConnectionFactory
import scala.concurrent.Future
import scala.xml.PrettyPrinter

abstract class RemoteEmailSender() extends interfaces.EmailSender {
  def serviceUrl: String

  val prettyPrinter = new PrettyPrinter(200, 2)


  def send(email: Email): Future[Odgovor] = {
    val bodyXml = email.toXml
    val bodyStr = prettyPrinter.format(bodyXml)
    val body = bodyStr.getBytes("UTF-8")

    Queue.sendAndClose("asdf", body)

    ???
  }

  object Queue {
    val factory = new ConnectionFactory()
    factory.setHost(serviceUrl)

    def sendAndClose(name: String, body: Array[Byte]) {
      val queue = new Queue(name)
      queue.send(body)
      queue.close()
    }
  }

  class Queue(val name: String) {
    import Queue._

    val connection = factory.newConnection
    val channel = connection.createChannel
    channel.queueDeclare(name, false, false, false, null);

    def send(body: Array[Byte]) {
      channel.basicPublish("", name, null, body)
    }

    def close() {
      channel.close()
      connection.close()
    }
  }
}
