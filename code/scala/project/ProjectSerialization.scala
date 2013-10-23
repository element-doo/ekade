import sbt._
import Keys._

object Serialization extends Build with Default with Dependencies {
  val generatedJava =
    unmanagedSourceDirectories in Compile := Seq(
      (javaSource in Compile).value.getParentFile.getParentFile / "generated" / "java"
    , (scalaSource in Compile).value
    )

  lazy val proto = (
    scalaProject("Serialization-Proto")
    inject(
      protobuf
    )
    settings(generatedJava)
  )

  lazy val json = (
    scalaProject("Serialization-Json")
    inject(
      dslHttp
    )
    settings(generatedJava)
  )
}
