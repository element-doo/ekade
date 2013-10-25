package com.emajliramokade
package services
package impl

import api.model.ImageSave.Zahtjev

import hr.ngs.patterns.ISerialization

class GoImageSaver(
    val serialization: ISerialization[String])
    extends abstracts.RemoteImageSaver
    with    RemotingDispatch[Zahtjev] {

  val method = "PUT"

  def serviceUrlFactory(t: Zahtjev) =
    s"http://emajliramokade.com:10080/Kada/${ t.getKadaID }/Slike"
}
