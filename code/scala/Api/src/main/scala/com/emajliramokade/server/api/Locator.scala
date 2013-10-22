package com.emajliramokade
package server
package api

import rest.RestListener
import services.EmailValidator
import services.impl.LaravelRemoteEmailValidator
import hr.ngs.patterns.{DependencyContainer, IServiceLocator}
import net.liftweb.http.rest.RestHelper
import org.slf4j.LoggerFactory
import scala.reflect.runtime.universe.TypeTag
import hr.ngs.patterns.JsonSerialization
import hr.ngs.patterns.ISerialization
import com.emajliramokade.dispatcher.Dispatcher
import com.emajliramokade.services.impl.FakeEmailValidator

object Locator extends IServiceLocator {
  private val container = {
    val logger = LoggerFactory.getLogger("EKade-Api")

    new DependencyContainer()
      .register[org.slf4j.Logger](logger)
      .register[RestListener, RestHelper]
      .register[JsonSerialization, ISerialization[String]]
      .register[LaravelRemoteEmailValidator]
      .register[FakeEmailValidator]
      .register[Dispatcher, Dispatcher]
  }

  def resolve[T: TypeTag] =
    container.resolve[T]
}
