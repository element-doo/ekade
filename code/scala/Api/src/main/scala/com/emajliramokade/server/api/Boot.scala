package com.emajliramokade
package server.api

import net.liftweb.http.{ Bootable, LiftRules }
import net.liftweb.http.rest.RestHelper

class Boot extends Bootable {
  def boot {
    LiftRules.addToPackages("com.emajliramokade.server.api")

    LiftRules.statelessDispatch.append(Locator[RestHelper])
  }
}
