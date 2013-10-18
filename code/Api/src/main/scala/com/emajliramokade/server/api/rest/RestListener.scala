package com.emajliramokade
package server
package api
package rest

import net.liftweb.http.{ PlainTextResponse, Req }
import net.liftweb.http.rest.RestHelper

import org.slf4j.Logger

class RestListener(
    logger: Logger
  ) extends RestHelper {

  serve {
    case req @ Req("ping" ::  Nil, _, _) =>
      PlainTextResponse("pong")
  }
}
