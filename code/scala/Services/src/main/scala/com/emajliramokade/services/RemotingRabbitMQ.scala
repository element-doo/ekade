package com.emajliramokade
package services

import com.rabbitmq.client.{ ConnectionFactory, QueueingConsumer }
import scala.concurrent.Future

private object RemotingRabbitMQ

trait RemotingRabbitMQ[T] extends Remoting[T] {
  def send(
    serviceUrl: String
  , request: Array[Byte]
  , headers: Map[String, String] = Map.empty
  ): Future[Array[Byte]] =

    Future {
      RemotingRabbitMQ synchronized {
        val queue = new RabbitQueue(serviceUrl)
        queue.send(request)
        queue.close()
      }

      "OK".toUTF8
    }

  private object RabbitQueue {
    val factory = new ConnectionFactory()
    factory.setHost("144.76.184.25")
    factory.setUsername("majstor")
    factory.setPassword("kadeOverAMQP")
  }

  private class RabbitQueue(val name: String) {
    import RabbitQueue._

    val connection = factory.newConnection
    val channel = connection.createChannel
    channel.queueDeclare(name, false, false, false, null);

    val consumer = new QueueingConsumer(channel);
    channel.basicConsume(name, true, consumer);

    def send(body: Array[Byte]) {
      channel.basicPublish("", name, null, body)
    }

    def receive(): Array[Byte] = {
      val delivery = consumer.nextDelivery()
      delivery.getBody
    }

    def close() {
      channel.close()
      connection.close()
    }
  }
}
