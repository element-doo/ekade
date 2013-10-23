package com.emajliramokade
package email.services
package impl

import hr.ngs.patterns.ISerialization

class LaravelRemoteEmailValidator(
    serialization: ISerialization[String]) extends abstracts.RemoteEmailValidator(serialization) {
  val serviceUrl = "http://emajliramokade.com:10070/zahtjev-check"
}
