import sbt._
import Keys._

object Email extends Build with Default with Dependencies {
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
