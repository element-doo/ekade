package com.emajliramokade.services.impl

import hr.ngs.patterns.ISerialization

class LaravelRemoteEmailValidator(
    serialization: ISerialization[String]) extends RemoteEmailValidator(serialization) {
  val serviceUrl = "http://emajliramokade.com:10070/zahtjev-check"
}
