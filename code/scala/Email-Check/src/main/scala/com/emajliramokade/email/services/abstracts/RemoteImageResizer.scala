package com.emajliramokade
package email.services
package abstracts

import api.model.ImageResize.{ ResizeZahtjev, Slika }

import java.lang.{Byte => JByte, Integer => JInt}
import java.nio.{ ByteBuffer, ByteOrder }
import scala.concurrent.Future

trait RemoteImageResizer
    extends interfaces.ImageResizer { this: Remoting =>

  def resize(original: Array[Byte], resizeTargetList: Seq[ResizeZahtjev]): Future[Map[ResizeZahtjev, Slika]] = {
    val targetSeqList  = resizeTargetList map resizeTargetToBA

    val payloadArr:     Array[Byte] = original.size.be32 ++ original
    val targetCountArr: Array[Byte] = resizeTargetList.size.be32
    val targetArr:      Array[Byte] = targetSeqList.flatten.toArray

    val reqArr: Array[Byte] = payloadArr ++ targetCountArr ++ targetArr

    send(reqArr) map { resArr =>
      val slikaList = parseRes(resArr) map new Slika().setBody
      resizeTargetList zip slikaList toMap
    }
  }

  private def parseRes(res: Array[Byte]): Array[Array[Byte]] = {
    def doParseRes(remainingRes: Array[Byte], bodyList: Array[Array[Byte]]): Array[Array[Byte]] = {
      val len = remainingRes.head
      val (body, newRes) = remainingRes.tail.splitAt(len)
      if (newRes.isEmpty) {
        bodyList
      } else {
        doParseRes(newRes, bodyList :+ body)
      }
    }

    doParseRes(res, Array())
  }

  private def resizeTargetToBA(rt: ResizeZahtjev): Array[Byte] =
    rt.getWidth.be32 ++ rt.getHeight.be32 ++ Array(rt.getDepth.toByte) ++ rt.getFormat.nullTerm(5)

  private implicit class RichString(s: String) {
    def nullTerm(length: Int): Array[Byte] = {
      require(s.length > length, "Specified length must be greater then string length")
      val padding = s.length - length
      s.getBytes("UTF-8").padTo(padding, 0.toByte)
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
}
