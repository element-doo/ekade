package com.emajliramokade.services.impl

import hr.ngs.patterns.ISerialization

class LaravelRemoteEmailValidator(
    serialization: ISerialization[String]) extends RemoteEmailValidator(serialization) {
  val serviceUrl = ""
}
