import sbt._
import Keys._

trait Repositories {
  val ElementNexus = "Element Nexus" at "http://www.element.hr/nexus/content/groups/public/"
}

//  ---------------------------------------------------------------------------

trait Resolvers extends Repositories {
  val resolverSettings = Seq(
    resolvers := Seq(
      ElementNexus
    ),
    externalResolvers <<= resolvers map { r =>
      Resolver.withDefaultResolvers(r, mavenCentral = true)
    }
  )
}
