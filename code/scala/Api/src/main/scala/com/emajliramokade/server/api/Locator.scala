package com.emajliramokade
package server.api

import net.liftweb.http.rest.RestHelper
import services.impl._
import server.api.rest.RestListener
import hr.ngs.patterns.{ DependencyContainer, ISerialization, IServiceLocator, JsonSerialization }
import org.slf4j.LoggerFactory
import scala.reflect.runtime.universe.TypeTag
import com.dslplatform.client.Bootstrap
import com.dslplatform.client.DomainProxy
import com.dslplatform.patterns.ServiceLocator
import com.emajliramokade.server.api.zmq.ZMQListener
import services.dispatchers._

object Locator extends IServiceLocator {
  private val container = {
    val logger = LoggerFactory.getLogger("EKade-Api")

    val locator = Bootstrap.init(sys.props("user.home") + "/.config/ekade/project.ini")
    val domainProxy = locator.resolve(classOf[DomainProxy])

    new DependencyContainer()
      .register[org.slf4j.Logger](logger)
      .register[JsonSerialization, ISerialization[String]]
      .register[RestListener, RestHelper]

      // EmailValidators
      .register[LaravelRemoteEmailValidator]
//      .register[RustRemoteEmailValidator]
      .register[DjangoRemoteEmailValidator]

      // EmailSenders
      .register[ClojureRemoteEmailSender]

      // ImageResizers
      .register[CLispRemoteImageResizer]

      // Platform
      .register[ServiceLocator](locator)
      .register[DomainProxy](domainProxy)

//      .register[ZMQListener]
      .register[EmailValidatorDispatcher]
      .register[EmailSenderDispatcher]
      .register[UploadDispatcher]
  }

  def resolve[T: TypeTag] =
    container.resolve[T]
}
