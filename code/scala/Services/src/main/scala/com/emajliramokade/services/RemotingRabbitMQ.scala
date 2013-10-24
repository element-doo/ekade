package com.emajliramokade
package services

import com.rabbitmq.client.{ ConnectionFactory, QueueingConsumer }
import scala.concurrent.Future

trait RemotingRabbitMQ[T] extends Remoting[T] {
  def send(serviceUrl: String, body: Array[Byte]): Future[Array[Byte]] =
    Future {
      val queue = new RabbitQueue(serviceUrl)
      queue.send(body)
      val response = queue.receive()
      queue.close()
      response
    }

  private object RabbitQueue {
    val factory = new ConnectionFactory()
    factory.setHost("")
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
