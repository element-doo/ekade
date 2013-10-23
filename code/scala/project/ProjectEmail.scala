import sbt._
import Keys._

object Email extends Build with Default with Dependencies {
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
      emailModel
    , rabbitMQ
    )
  )
}
