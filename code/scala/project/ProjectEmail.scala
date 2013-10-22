import sbt._
import Keys._

object Email extends Build with Default with Dependencies {
  lazy val emailXml = (
    scalaProject("Email-Xml")
    inject(
      etbUtil
    , mimeTypes
    , scalaTest
    )
  )
  
  lazy val emailSender = (
    scalaProject("Email-Sender")
    inject(
      emailXml
    , rabbitMQ
    )
  )
}
