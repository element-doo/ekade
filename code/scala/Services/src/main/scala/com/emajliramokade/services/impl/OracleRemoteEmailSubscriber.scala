package com.emajliramokade
package services
package impl

import api.model.EmailRegistracija.Zahtjev

import hr.ngs.patterns.ISerialization
import scala.concurrent.Future

class OracleRemoteEmailSubscriber(
    val serialization: ISerialization[String])
    extends abstracts.RemoteEmailSubscriber
    with    RemotingDispatch[Zahtjev] {

  val method = "GET"

  def serviceUrlFactory(t: Zahtjev) =
    s"http://emajliramokade.com:8080/apex/novine/odjave/check/${ t.getEmail }"
}
