package com.emajliramokade
package services

import scala.concurrent.Future

trait Remoting[T] {
  def serviceUrlFactory(t: T): String
  def send(serviceUrl: String, body: Array[Byte]): Future[Array[Byte]]
}
