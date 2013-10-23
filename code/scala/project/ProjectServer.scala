import sbt._
import Keys._

object Server extends Build with Default with Dependencies {
  // Root project. Container and central dispatcher.
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
      , Util.root
    )
    settings(liftSettings(10040, "emajliramokade.war"): _*)
  )
}
