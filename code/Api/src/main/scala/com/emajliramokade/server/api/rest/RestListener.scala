package com.emajliramokade
package server
package api
package rest

import org.slf4j.Logger

import net.liftweb.http.PlainTextResponse
import net.liftweb.http.Req
import net.liftweb.http.rest.RestHelper

object RestListener extends RestHelper {
  serve {
    case req @ Req("ping" ::  Nil, _, _) =>
      PlainTextResponse("pong")
  }
}
