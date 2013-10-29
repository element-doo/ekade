package com.emajliramokade
package services
package abstracts

import api.model.ImageResize.{ ResizeZahtjev, Slika }

import java.lang.{Byte => JByte, Integer => JInt}
import java.nio.{ ByteBuffer, ByteOrder }
import scala.concurrent.Future

trait RemoteImageResizer
    extends interfaces.ImageResizer { this: Remoting[Seq[ResizeZahtjev]] =>

  def resize(original: Array[Byte], resizeTargetList: Seq[ResizeZahtjev]): Future[Map[ResizeZahtjev, Slika]] = {
    val targetSeqList  = resizeTargetList map resizeTargetToBA

    val payloadArr:     Array[Byte] = original.size.be32 ++ original
    val targetCountArr: Array[Byte] = resizeTargetList.size.be32
    val targetArr:      Array[Byte] = targetSeqList.flatten.toArray

    val serviceUrl = serviceUrlFactory(resizeTargetList)
    val reqArr: Array[Byte] = payloadArr ++ targetCountArr ++ targetArr
    send(serviceUrl, reqArr) map { resArr =>
      val slikaList = parseRes(resArr) map { res =>
        new Slika().setBody(res)
      }
      resizeTargetList zip slikaList toMap
    }
  }

  private def parseRes(res: Array[Byte]): Array[Array[Byte]] = {
    def doParseRes(resPos: Int, bodyList: Array[Array[Byte]]): Array[Array[Byte]] = {
      if (resPos >= res.length) {
        bodyList
      } else {
        val len = res.getInt(resPos)
        val body = res.slice(resPos+4, resPos + 4 + len)
        doParseRes(resPos + 4 + len, bodyList :+ body)
      }
    }

    doParseRes(4, Array())
  }

  private def resizeTargetToBA(rt: ResizeZahtjev): Array[Byte] =
    rt.getWidth.be32 ++ rt.getHeight.be32 ++ Array(rt.getDepth.toByte) ++ rt.getFormat.toUTF8

  private implicit class RichString(s: String) {
    def nullTerm(length: Int): Array[Byte] = {
      require(length > s.length, "Specified length must be greater then string length")
      val padding = length - s.length
      s.toUTF8.padTo(padding, 0.toByte)
    }
  }

  private implicit class RichInt(i: Int) {
    def be32: Array[Byte] =
      ByteBuffer
        .allocate(JInt.SIZE / JByte.SIZE)
        .order(ByteOrder.BIG_ENDIAN)
        .putInt(i)
        .array
  }

  private implicit class PimpedByteArray(ba: Array[Byte]) {
    def getInt(position: Int) =
      ByteBuffer.wrap(ba, position, 4).getInt
  }

}
