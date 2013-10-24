package com.emajliramokade
package services
package impl

import api.model.EmailProvjera.Zahtjev

import hr.ngs.patterns.ISerialization

class DjangoRemoteEmailValidator(
    protected val serialization: ISerialization[String])
    extends abstracts.RemoteEmailValidator
    with    RemotingDispatch[Zahtjev] {

  val method = "POST"

  // TODO: Switch to localhost in production
  //"http://localhost:10060/api/v1/check/"
  def serviceUrlFactory(t: Zahtjev) =
    "https://emajliramokade.com/api/v1/check/"
}
