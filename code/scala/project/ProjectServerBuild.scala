import sbt._
import Keys._

object Server extends Build with Default with Dependencies {
  lazy val api = (
    scalaProject("Api")
    inject(
      lift
    , jetty
    , logback
//    , akka
//    , ngsCore
//    , jeroMQ
//    , rabbitMQ
//    , protobuf
//    , dispatch
//    , etbUtil
//    , mimeTypes
//    , Serialization.json
//    , Serialization.proto
    )
    settings(liftSettings(10040, "emajliramokade.war"): _*)
  )
}
