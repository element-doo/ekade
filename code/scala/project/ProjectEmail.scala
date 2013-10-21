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
}
