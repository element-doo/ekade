package com.emajliramokade
package server
package api

import net.liftweb.http.Bootable
import net.liftweb.http.LiftRules
import net.liftweb.http.Req
import net.liftweb.http.rest.RestHelper
import net.liftweb.http.XHtmlInHtml5OutProperties

class Boot extends Bootable {
  def boot {
    LiftRules.addToPackages("com.emajliramokade.server.api")

    LiftRules.statelessDispatch.append(rest.RestListener)

    LiftRules.early.append(_.setCharacterEncoding("UTF-8"))
    LiftRules.htmlProperties.default.set((r: Req) =>
      XHtmlInHtml5OutProperties(r.userAgent)
    )
  }
}
