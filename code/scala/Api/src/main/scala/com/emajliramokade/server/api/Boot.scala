package com.emajliramokade
package server
package api

import net.liftweb.http.{Bootable, LiftRules}
import net.liftweb.http.LiftRulesMocker.toLiftRules
import net.liftweb.http.rest.RestHelper
import scala.reflect.runtime.universe

class Boot extends Bootable {
  def boot {
    LiftRules.addToPackages("com.emajliramokade.server.api")

    LiftRules.statelessDispatch.append(Locator[RestHelper])
  }
}
