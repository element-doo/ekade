package com.emajliramokade
package server.api

import services.impl.{ FakeEmailValidator, LaravelRemoteEmailValidator }
import server.api.rest.RestListener

import hr.ngs.patterns.{ DependencyContainer, ISerialization, IServiceLocator, JsonSerialization }
import net.liftweb.http.rest.RestHelper
import org.slf4j.LoggerFactory
import scala.reflect.runtime.universe.TypeTag

object Locator extends IServiceLocator {
  private val container = {
    val logger = LoggerFactory.getLogger("EKade-Api")

    new DependencyContainer()
      .register[org.slf4j.Logger](logger)
      .register[JsonSerialization, ISerialization[String]]
      .register[RestListener, RestHelper]
      .register[LaravelRemoteEmailValidator]
      .register[FakeEmailValidator]
      .register[Dispatcher]
  }

  def resolve[T: TypeTag] =
    container.resolve[T]
}
