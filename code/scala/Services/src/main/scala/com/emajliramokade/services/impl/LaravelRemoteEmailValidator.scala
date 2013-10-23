package com.emajliramokade
package services
package impl

import hr.ngs.patterns.ISerialization

class LaravelRemoteEmailValidator(
    val serialization: ISerialization[String])
    extends abstracts.RemoteEmailValidator
    with    RemotingDispatch {
  val serviceUrl = "http://emajliramokade.com:10070/zahtjev-check"
}
