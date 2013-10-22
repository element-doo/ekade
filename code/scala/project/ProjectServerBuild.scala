import sbt._
import Keys._

object Server extends Build with Default with Dependencies {
  lazy val api = (
    scalaProject("Api")
    inject(
      lift
    , jetty
    , logback
    , ngsCore
    , jeroMQ
    , rabbitMQ
    , protobuf
    , akka
    , dispatch
    , etbUtil
    , mimeTypes
    )
    settings(liftSettings(10040, "emajliramokade.war"): _*)
  )
}
