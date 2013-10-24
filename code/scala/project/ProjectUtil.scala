import sbt._
import Keys._

object Util extends Build with Default with Dependencies {
  // Common utils for all other projects.
  lazy val root = (
    scalaProject("Util")
    inject(
    )
  )
}
