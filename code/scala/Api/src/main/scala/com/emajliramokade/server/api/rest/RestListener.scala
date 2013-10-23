package com.emajliramokade
package server
package api
package rest

import net.liftweb.http.{PlainTextResponse, Req}
import net.liftweb.http.rest.RestHelper
import org.slf4j.Logger
import net.liftweb.http.PostRequest
import scala.util.Try
import scala.util.Success
import scala.util.Failure
import net.liftweb.http.LiftResponse
import scala.concurrent.Await
import scala.concurrent.duration._
import hr.ngs.patterns.ISerialization

class RestListener(
    logger: Logger
  , serialization: ISerialization[String]
//  , dispatcher: Dispatcher
  ) extends RestHelper {

  serve {
    case req @ Req("ping" ::  Nil, _, _) =>
      PlainTextResponse("pong")

    case req @ Req(x, _, PostRequest) =>
      parseBody(req) orElse parseParams(req) match {
        case Success(zahtjev) =>
          val resFut = dispatcher.dispatch(zahtjev)
          val res = Await.result(resFut, 60 seconds)
          odgovorToResponse(res)

        case Failure(e) =>
          odgovorToResponse(new Odgovor(false, e.toString))
      }
  }

  def odgovorToResponse(odgovor: Odgovor): LiftResponse = {
    val body = serialization.serialize(odgovor)
    val code = if (odgovor.getStatus) 200 else 400
    PlainTextResponse(body, List("Content-type" -> "application/json; charset=UTF-8"), code)
  }

  // {"email":"\"Đoni Šiš\" <đonatan.čevapčić@example.com>"}
  def parseBody(req: Req): Try[Zahtjev] =
    Try {
      val body = req.body.openTheBox
      val strBody = new String(body, "UTF-8")
      serialization.deserialize[Zahtjev](strBody, Locator)
    }

  // Map(email -> List("Đoni Šiš" <đonatan.čevapčić@example.com>))
  def parseParams(req: Req): Try[Zahtjev] =
    Try {
      val params = req._params
      val email = params("email").head
      val kadaID = params.get("kadaID") flatMap (_.headOption) orNull

      new Zahtjev()
        .setEmail(email)
        .setKadaID(kadaID)
    }
}
