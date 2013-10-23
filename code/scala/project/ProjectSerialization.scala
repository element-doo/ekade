import sbt._
import Keys._

object Serialization extends Build with Default with Dependencies {
  val generatedJava =
    unmanagedSourceDirectories in Compile := Seq(
      (javaSource in Compile).value.getParentFile.getParentFile / "generated" / "java"
    , (scalaSource in Compile).value
    )

  // Provides binary serialization for communication over 0MQ.
  lazy val proto = (
    scalaProject("Serialization-Proto")
    inject(
      protobuf
      , Util.root
    )
    settings(generatedJava)
  )

  // Provides JSON serialization for communication over HTTP REST.
  lazy val json = (
    scalaProject("Serialization-Json")
    inject(
      dslHttp
      , Util.root
    )
    settings(generatedJava)
  )
}
