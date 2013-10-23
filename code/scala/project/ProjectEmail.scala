import sbt._
import Keys._

object Email extends Build with Default with Dependencies {
  // Uses 0MQ and HTTP REST over JSON to validate Email addresses and MX records.
  // Email and MX validation are written in Rust, Python and PHP (quorum decision: two of three)
  lazy val emailCheck = (
    scalaProject("Email-Check")
    inject(
      dispatch
    , jeroMQ
    , akka
    , jzmq
    , ngsInterfaces
    , Email.emailSender
    , Serialization.json
    , Serialization.proto
    , Util.root
    )
  )

  // Hand-written Email  <--> XML serializator.
  lazy val emailModel = (
    scalaProject("Email-Model")
    inject(
      etbUtil
    , mimeTypes
    , scalaTest
    , Util.root
    )
  )

  // Connects to email sender (written in Clojure), using XML serialization over AMQP.
  lazy val emailSender = (
    scalaProject("Email-Sender")
    inject(
      Email.emailModel
    , rabbitMQ
    , Util.root
    )
  )
}
