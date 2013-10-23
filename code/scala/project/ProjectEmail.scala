import sbt._
import Keys._

object Email extends Build with Default with Dependencies {
  lazy val emailCheck = (
    scalaProject("Email-Check")
    inject(
      dispatch
    , jeroMQ
    , akka
    , Email.emailSender
    , Serialization.json
    , Serialization.proto
    )
  )

  lazy val emailModel = (
    scalaProject("Email-Model")
    inject(
      etbUtil
    , mimeTypes
    , scalaTest
    )
  )

  lazy val emailSender = (
    scalaProject("Email-Sender")
    inject(
      Email.emailModel
    , rabbitMQ
    )
  )
}
