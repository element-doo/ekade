package com.emajliramokade
package services

import scala.concurrent.Future

trait Remoting[T] {
  def serviceUrlFactory(t: T): String

  def send(
    serviceUrl: String
  , request: Array[Byte]
  , headers: Map[String, String] = Map.empty
  ): Future[Array[Byte]]
}
