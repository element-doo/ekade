package com.emajliramokade
package server.api

import net.liftweb.http.rest.RestHelper
import services.impl._
import server.api.rest._
import hr.ngs.patterns.{ DependencyContainer, ISerialization, IServiceLocator, JsonSerialization }
import org.slf4j.LoggerFactory
import scala.reflect.runtime.universe.TypeTag
import com.dslplatform.client.Bootstrap
import com.dslplatform.client.DomainProxy
import com.dslplatform.patterns.ServiceLocator
import com.emajliramokade.server.api.zmq.ZMQListener
import services.dispatchers._
import api.model.Resursi.repositories.SlikeKadeRepository

object Locator extends IServiceLocator {
  private val container = {
    val logger = LoggerFactory.getLogger("EKade-Api")

    val locator = Bootstrap.init(sys.props("user.home") + "/.config/ekade/project.ini")
    val domainProxy = locator.resolve(classOf[DomainProxy])
    val slikeKadeRepo = locator.resolve(classOf[SlikeKadeRepository])

    new DependencyContainer()
      .register[org.slf4j.Logger](logger)
      .register[JsonSerialization, ISerialization[String]]
      .register[EmailListener]
      //.register[SlikaListener]

      // EmailValidators
      .register[LaravelRemoteEmailValidator]
      .register[RustRemoteEmailValidator]
      .register[DjangoRemoteEmailValidator]

      // EmailSenders
      .register[ClojureRemoteEmailSender]
      .register[PlatformRemoteEmailSender]

      // ImageResizers
      .register[CLispRemoteImageResizer]

      // Platform
      .register[ServiceLocator](locator)
      .register[DomainProxy](domainProxy)
      .register[SlikeKadeRepository](slikeKadeRepo)

      .register[OracleRemoteEmailSubscriber]

      // ImageCRUD
      .register[GoPlatformImageLoader]
      .register[GoImageSaver]

      .register[ZMQListener]
      .register[EmailValidatorDispatcher]
      .register[EmailSenderDispatcher]
      .register[UploadDispatcher]
  }

  def resolve[T: TypeTag] =
    container.resolve[T]
}
