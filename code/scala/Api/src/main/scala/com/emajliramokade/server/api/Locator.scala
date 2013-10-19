package com.emajliramokade
package server
package api

import rest.RestListener
import hr.ngs.patterns.{DependencyContainer, IServiceLocator}
import net.liftweb.http.rest.RestHelper
import org.slf4j.LoggerFactory
import scala.reflect.runtime.universe.TypeTag
import hr.ngs.patterns.JsonSerialization
import hr.ngs.patterns.ISerialization

object Locator extends IServiceLocator {
  private val container = {
    val logger = LoggerFactory.getLogger("EKade-Api")

    new DependencyContainer()
      .register[org.slf4j.Logger](logger)
      .register[RestListener, RestHelper]
      .register[JsonSerialization, ISerialization[String]]
  }

  def resolve[T: TypeTag] =
    container.resolve[T]
}
