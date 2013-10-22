import sbt._
import Keys._

trait Dependencies  {
  val logback       = "ch.qos.logback" % "logback-classic" % "1.0.13" % "compile->default"
  val scalaLogging  = "com.typesafe" %% "scalalogging-slf4j" % "1.0.1"

  val liftVersion = "2.5.1"
  val lift = Seq(
    "net.liftweb" %% "lift-common" % liftVersion
  , "net.liftweb" %% "lift-util"   % liftVersion
  , "net.liftweb" %% "lift-webkit" % liftVersion
  )

  val jetty         = Seq(
    "org.eclipse.jetty" % "jetty-webapp" % "8.1.13.v20130916" % "container"
  , "org.eclipse.jetty.orbit" % "javax.servlet" % "3.0.0.v201112011016" % "container" artifacts Artifact("javax.servlet", "jar", "jar")
  )

  val etbUtil       = "hr.element.etb"  %% "etb-util" % "0.2.20"
  val ngsInterfaces = "hr.ngs" %% "ngs-interfaces" % "0.3.19"
  val ngsCore       = "hr.ngs" %% "ngs-core" % "0.3.19"
  val mimeTypes     = "hr.element.onebyseven.common" % "mimetypes" % "2013-10-21"

  val jeroMQ        = "org.jeromq" % "jeromq" % "0.2.0"
  val rabbitMQ      = "com.rabbitmq" % "amqp-client" % "3.1.4"
  val protobuf      = "com.google.protobuf" % "protobuf-java" % "2.5.0"
  val akka          = "com.typesafe.akka" %% "akka-actor" % "2.2.1"

  val dslHttp       = "com.dslplatform" % "dsl-client-http" % "0.4.13" 
  val dispatch      = "net.databinder.dispatch" %% "dispatch-core" % "0.11.0"

  val scalaTest     = Seq(
    "org.scalatest" %% "scalatest" % "2.0.RC2" % "test"
  , "junit" % "junit" % "4.11" % "test"
  )
}
