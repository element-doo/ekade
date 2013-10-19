import sbt._
import Keys._

trait Dependencies  {
  val logback       = "ch.qos.logback" % "logback-classic" % "1.0.13" % "compile->default"
  val scalaLogging  = "com.typesafe" %% "scalalogging-slf4j" % "1.0.1"

  val liftWebkit    = "net.liftweb" %% "lift-webkit" % "2.5.1"
  val jetty         = Seq(
    "org.eclipse.jetty" % "jetty-webapp" % "8.1.13.v20130916" % "container"
  , "org.eclipse.jetty.orbit" % "javax.servlet" % "3.0.0.v201112011016" % "container" artifacts Artifact("javax.servlet", "jar", "jar")
  )

  val scalaTime     = "com.github.nscala-time" %% "nscala-time" % "0.6.0"

  val ngsInterfaces = "hr.ngs" %% "ngs-interfaces" % "0.3.19"
  val ngsCore       = "hr.ngs" %% "ngs-core" % "0.3.19"

  val jeroMQ        = "org.jeromq" % "jeromq" % "0.2.0"

  val protobuf      = "com.google.protobuf" % "protobuf-java" % "2.5.0"

  val akka          = "com.typesafe.akka" %% "akka-actor" % "2.2.1"
}
