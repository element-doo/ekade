package com.emajliramokade
package server.api
package rest

import api.model.EmailProvjera.{ Odgovor, Zahtjev }

import hr.ngs.patterns.ISerialization
import net.liftweb.http.{ LiftResponse, PlainTextResponse, PostRequest, Req }
import net.liftweb.http.rest.RestHelper
import org.slf4j.Logger
import scala.concurrent.Await
import scala.concurrent.duration._
import scala.util.{ Failure, Success, Try }
import io.jvm.uuid._

class RestListener(
    logger: Logger
  , serialization: ISerialization[String]
  , dispatcher: Dispatcher
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
    PlainTextResponse(body, List("Content-type" -> s"application/json; charset=$Encoding"), code)
  }

  // {"email":"\"Đoni Šiš\" <đonatan.čevapčić@example.com>"}
  def parseBody(req: Req): Try[Zahtjev] =
    Try {
      val body = req.body.openOrThrowException("Tried to open an empty body box")
      val strBody = body.fromUTF8
      serialization.deserialize[Zahtjev](strBody, null)
    }

  // Map(email -> List("Đoni Šiš" <đonatan.čevapčić@example.com>))
  def parseParams(req: Req): Try[Zahtjev] =
    Try {
      val params = req._params

      val email = params("email").head
      val kadaID = Try {
        UUID(params("kadaID").head)
      }

      new Zahtjev()
        .setEmail(email)
        .setKadaID(kadaID getOrElse null)
    }
}
