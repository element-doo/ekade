package com.emajliramokade
package email.services

import dispatch._
import scala.concurrent.Future

trait RemotingDispatch extends Remoting with Service {
  def send(request: Array[Byte]): Future[Array[Byte]] = {
    val req = url(serviceUrl).setBody(request)

    Http(req) map { response =>
      response.getResponseBodyAsBytes()
    }
  }
}
