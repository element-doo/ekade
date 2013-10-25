package com.emajliramokade
package services
package impl

import api.model.EmailProvjera.Zahtjev

import hr.ngs.patterns.ISerialization

class LaravelRemoteEmailValidator(
    val serialization: ISerialization[String])
    extends abstracts.RemoteEmailValidator
    with    RemotingDispatch[Zahtjev] {

  val method = "POST"

  def serviceUrlFactory(t: Zahtjev) =
    "http://emajliramokade.com:10070/zahtjev-check"
}
