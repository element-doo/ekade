package com.emajliramokade
package services
package abstracts

import api.model.EmailRegistracija.{ Odgovor, Zahtjev }

import scala.concurrent.Future
import scala.xml.PrettyPrinter

trait RemoteEmailSubscriber
    extends Serializator
    with    interfaces.EmailSubscriber { this: Remoting[Zahtjev] =>

  def subscribe(zahtjev: Zahtjev): Future[Odgovor] = {
    val serviceUrl = serviceUrlFactory(zahtjev)

    send(serviceUrl, Array()) map { resBody =>
      val resStr = resBody.fromUTF8
      val resMap = serialization.deserialize[Map[String, String]](resStr, null)
      val unsubscribeID = resMap.get("emhash").getOrElse("")
      new Odgovor()
        .setOdjavljen(unsubscribeID.isEmpty)
        .setUnsubscribeID(unsubscribeID)
    }
  }
}
