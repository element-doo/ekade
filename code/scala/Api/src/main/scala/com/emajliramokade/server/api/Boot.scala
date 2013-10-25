package com.emajliramokade
package server.api

import net.liftweb.http.{ Bootable, LiftRules }
import net.liftweb.http.rest.RestHelper
import com.emajliramokade.server.api.zmq.ZMQListener

class Boot extends Bootable {
  def boot {
    LiftRules.addToPackages("com.emajliramokade.server.api")

//    LiftRules.statelessDispatch.append(Locator[RestHelper])

    val runEntryPoint = Locator[ZMQListener]
  }
}
