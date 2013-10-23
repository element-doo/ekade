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
//    , akka
//    , rabbitMQ
//    , dispatch
//    , etbUtil
//    , mimeTypes
      , Email.emailCheck
    )
    settings(liftSettings(10040, "emajliramokade.war"): _*)
  )
}
