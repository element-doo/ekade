import sbt._
import Keys._

object Services extends Build with Default with Dependencies {
  // Uses 0MQ and HTTP REST over JSON to validate Email addresses and MX records.
  // Email and MX validation are written in Rust, Python and PHP (quorum decision: two of three)
  lazy val root = (
    scalaProject("Services")
    inject(
      dispatch
    , jeroMQ
    , akka
    , jzmq
    , rabbitMQ
    , ngsInterfaces
    , Email.emailSender
    , Serialization.json
    , Serialization.proto
    , Util.root
    )
  )
}
