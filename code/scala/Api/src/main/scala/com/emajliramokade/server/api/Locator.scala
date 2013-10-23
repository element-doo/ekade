package com.emajliramokade
package server
package api

import hr.ngs.patterns._
import org.slf4j.LoggerFactory

object Locator extends IServiceLocator {
  private val container = {
    val logger = LoggerFactory.getLogger("EKade-Api")

    new DependencyContainer()
      .register[org.slf4j.Logger](logger)
      .register[JsonSerialization, ISerialization[String]]
      .register[RestListener, RestHelper]
//      .register[LaravelRemoteEmailValidator]
//      .register[FakeEmailValidator]
//      .register[Dispatcher, Dispatcher]
  }

  def resolve[T: TypeTag] =
    container.resolve[T]
}
