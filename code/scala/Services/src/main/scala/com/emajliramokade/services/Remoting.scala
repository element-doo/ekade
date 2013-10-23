package com.emajliramokade
package services

import scala.concurrent.Future

trait Remoting {
  def send(body: Array[Byte]): Future[Array[Byte]]
}
