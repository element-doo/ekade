package com.emajliramokade.server.api

import scala.io.Source
import scala.reflect.runtime.universe.TypeTag
import org.slf4j.LoggerFactory
import hr.ngs.patterns._
import net.liftweb.http.rest.RestHelper
import rest.RestListener

object Locator extends IServiceLocator {
  private val container = {
    val logger = LoggerFactory.getLogger("EmajliramoKade-Api")

    new DependencyContainer()
      .register[org.slf4j.Logger](logger)
      .register[RestListener, RestHelper]
  }

  def resolve[T: TypeTag] =
    container.resolve[T]
}
