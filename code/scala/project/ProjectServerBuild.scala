import sbt._
import Keys._

trait Server extends Build with Default with Dependencies {
  protected def scalaProject(id: String) = Project(
    id
  , file(id)
  , settings = scalaSettings ++ Seq(
      version := "0.0.0-SNAPSHOT"
    , name := "EKade-" + id
    , organization := "com.emajliramokade"
    , initialCommands := "import com.emajliramokade._"
    )
  )
}

object Server extends Server {
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
