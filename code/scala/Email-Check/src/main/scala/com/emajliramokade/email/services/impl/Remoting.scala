package com.emajliramokade
package email.services
package impl

import api.model.EmailProvjera.{ Odgovor, Zahtjev }

import dispatch._
import hr.ngs.patterns.ISerialization
import scala.concurrent.Future

trait Remoting {
  val serialization: ISerialization[String]
  def serviceUrl: String

  def sendRaw(request: Array[Byte]): Future[Array[Byte]] = {
    val req = url(serviceUrl).setBody(request)

    Http(req) map { response =>
      response.getResponseBodyAsBytes()
    }
  }

  def sendZahtjev(zahtjev: Zahtjev): Future[Odgovor] = {
    val reqStr  = serialization.serialize(zahtjev)
    val reqBody = reqStr.getBytes

    sendRaw(reqBody) map { resBody =>
      val resStr = new String(resBody, "UTF-8")
      serialization.deserialize[Odgovor](resStr, null)
    }
  }
}
