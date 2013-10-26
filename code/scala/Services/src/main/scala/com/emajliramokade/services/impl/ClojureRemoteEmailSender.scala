package com.emajliramokade
package services
package impl

import hr.ngs.patterns.ISerialization
import email._

object ClojureRemoteEmailSender
    extends abstracts.RemoteEmailSender
    with    RemotingRabbitMQ[Email] {

  def serviceUrlFactory(t: Email) =
    "email.request"
}
