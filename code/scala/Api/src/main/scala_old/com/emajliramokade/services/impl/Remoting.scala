package com.emajliramokade
package services.impl

import scala.concurrent.Future
import dispatch._
import hr.ngs.patterns.ISerialization
import com.emajliramokade.api.model.Api.Odgovor
import com.emajliramokade.api.model.Api.Zahtjev
import com.emajliramokade.server.api.Locator

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
      serialization.deserialize[Odgovor](resStr, Locator)
    }
  }
}
