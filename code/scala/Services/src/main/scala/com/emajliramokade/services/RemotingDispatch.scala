package com.emajliramokade
package services

import dispatch._
import scala.concurrent.Future

trait RemotingDispatch[T] extends Remoting[T] {
  def method: String

  def send(serviceUrl: String, request: Array[Byte]): Future[Array[Byte]] = {
    val req = url(serviceUrl).setBody(request).setMethod(method)

    Http(req) map { response =>
      response.getResponseBodyAsBytes()
    }
  }
}
