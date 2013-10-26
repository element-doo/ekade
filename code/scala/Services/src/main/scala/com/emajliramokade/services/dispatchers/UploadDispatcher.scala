package com.emajliramokade
package services
package dispatchers

import api.{ model => m}
import image.{ proto => p}
import services.interfaces._
import com.google.protobuf.ByteString
import java.util.UUID
import org.slf4j.Logger
import scala.concurrent.{ Await, Future }
import scala.concurrent.duration.Duration
import scala.util.Try

class UploadDispatcher(
    provjeravatelj: Array[ImageVerifier],
    stezatelj: Array[ImageResizer],
    logger: Logger) {
  private object Dimenzija {
    def fromProto(odgovor: p.ImageProvjera.Odgovor) =
      Dimenzija(odgovor.getDimenzijeSlike.getWidth, odgovor.getDimenzijeSlike.getHeight)
  }

  private case class Dimenzija(width: Int, height: Int) {
    override def toString = s"${ width }x${ height }"
  }

  private def timeoutWithDefault[T](in: Future[T], default: T)(implicit timeout: Duration): T =
    Try {
      Await.result(in, timeout)
    } getOrElse {
      default
    }

  implicit val timeout = ServiceTimeout

  def dispatch(slikaBody: Array[Byte]) {
    // Izdiviniraj UUID za ovu sliku.
    val slikaID = UUID.randomUUID

    for {
      provjeriOdgovor      <- provjeri(slikaBody).right                      // Pošalji sliku na provjeru, i utvrđivanje dimenzija.
      listaVeličinaOdgovor <- dohvatiListuVeličina(provjeriOdgovor).right    // Utvrdi na koje sve veličine treba resizeat stvar.
      stezateljOdgovor     <- stegni(slikaBody, listaVeličinaOdgovor).right  // Pošalji sliku na resizeanje.
      // Perzistiraj meta podatke o slici.
      // Perzistiraj samu sliku.
    } yield {
      5 // Ne znamo još šta sa rezultatom
    }
  }

  private def provjeri(slikaBody: Array[Byte]): Either[String, Dimenzija] = {
//    logger.info(s"provjeri | Šaljem sliku na provjeru [size=${ slikaBody.size } bytes]...")
//    logger.debug("provjeri | Gradim zahtjev...")
//    val protoBody = ByteString.copyFrom(slikaBody)
//    val zahtjevBuilder = p.ImageProvjera.Zahtjev.newBuilder
//    zahtjevBuilder setOriginalnaSlika protoBody
//    val zahtjev = zahtjevBuilder.build
//
//    logger.debug("provjeri | Gradim odgovor u slučaju greške...")
//    val defaultOdgovorBuilder = p.ImageProvjera.Odgovor.newBuilder
//    defaultOdgovorBuilder.setStatus(false)
//    defaultOdgovorBuilder.setPoruka("Greška tokom provjere slike")
//    val defaultOdgovor = defaultOdgovorBuilder.build
//
//    logger.debug(s"provjeri | Izgradio zahtjev, šaljem servisu ${ provjeravatelj(0).getClass.getSimpleName }...")
//    val odgovor = timeoutWithDefault(provjeravatelj(0).verify(zahtjev), defaultOdgovor)
//    logger.debug(s"provjeri | Odgovor primljen: [status=${ odgovor.getStatus }; poruka=${ odgovor.getPoruka }; dimenzije=${ odgovor.getDimenzijeSlike.getWidth }x${ odgovor.getDimenzijeSlike.getHeight }]")
//
//    if (odgovor.getStatus) {
//      logger.debug("provjeri | Vraćam usjpešan rezultat")
//      Right(Dimenzija.fromProto(odgovor))
//    } else {
//      logger.debug("provjeri | Vraćam neuspješan rezultat")
//      Left(odgovor.getPoruka)
//    }

    Right(Dimenzija(158, 95))
  }

  private def dohvatiListuVeličina(originalnaVeličina: Dimenzija): Either[String, Map[String, Dimenzija]] = {
    logger.info(s"dohvatiListuVeličina | Dohvaćam ciljanu listu dimenzija [originalnaVeličina=$originalnaVeličina]...")
    logger.debug("dohvatiListuVeličina | Fakeam listu veličina")
    val listaVeličina = Map(
        "thumb" -> Dimenzija(100, 100),
        "web"   -> Dimenzija(200, 200))
    logger.debug(s"dohvatiListuVeličina | Lista veličina dohvaćena: [${ listaVeličina.mkString(", ") }]")
    Right(listaVeličina)
  }

  private def stegni(slikaBody: Array[Byte], listaVeličina: Map[String, Dimenzija]): Either[String, Map[String, Array[Byte]]] = {
    def dohvatiZahtjev(dimenzija: (String, Dimenzija)) =
      new m.ImageResize.ResizeZahtjev()
        .setWidth(dimenzija._2.width)
        .setHeight(dimenzija._2.height)
        .setDepth(24)
        .setFormat("jpg0_")

    logger.info(s"stegni | Šaljem sliku na stezanje [listaVeličina=${ listaVeličina.mkString(", ") }]...")
    logger.debug("stegni | Gradim zahtjeve...")
    val zahtjevList = listaVeličina map dohvatiZahtjev toSeq

    logger.debug("stegni | Gradim odgovor u slučaju greške...")
    val defaultOdgovor = Map()

    logger.debug(s"stegni | Izgradio zahtjev, šaljem servisu ${ stezatelj(0).getClass.getSimpleName }...")
    val odgovor = timeoutWithDefault(stezatelj(0).resize(slikaBody, zahtjevList), defaultOdgovor)
    logger.debug(s"stegni | Odgovor primljen. Veličine primljenih slika: [${ odgovor.values.map(_.getBody.size).mkString(", ") }]")

    val dimenzijeSaSlikama = odgovor.map {
      case (stegniZahtjev, stegnutaSlika) =>
        Dimenzija(stegniZahtjev.getWidth, stegniZahtjev.getHeight) -> stegnutaSlika.getBody
    } toMap

    logger.debug(s"stegni | Dimenzije i veličine stegnutih slika: [${ dimenzijeSaSlikama.mapValues(_.size).mkString(", ") }]")

    val opisiSaSlikama = dimenzijeSaSlikama flatMap {
      case (dimenzija, stegnutaSlika) =>
        val opisOpt = listaVeličina.find(_._2 == dimenzija).map(_._1)
        opisOpt map { opis =>
          opis -> stegnutaSlika
        }
    } toMap


    if (opisiSaSlikama.size == listaVeličina.size) {
      logger.debug("stegni | Vraćam usjpešan rezultat")
      Right(opisiSaSlikama)
    } else {
      logger.debug("stegni | Vraćam neuspješan rezultat")
      Left("Greška tokom stezanja slike")
    }
  }
}
