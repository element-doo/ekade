package com.emajliramokade
package services.impl

import com.emajliramokade.services.ImageResizer
import scala.concurrent.Future
import com.emajliramokade.services.ResizeTarget
import java.nio.ByteBuffer
import java.lang.{ Integer => JInt, Byte => JByte }
import java.nio.ByteOrder

abstract class CLispImageResizer extends ImageResizer with Remoting {
  def serviceUrl: String

  def resize(original: Array[Byte], resizeTargetList: Seq[ResizeTarget]): Future[Map[(ResizeTarget), Array[Byte]]] = {
    val targetSeqList  = resizeTargetList map resizeTargetToBA

    val payloadArr:     Array[Byte] = original.size.lsb32 ++ original
    val targetCountArr: Array[Byte] = resizeTargetList.size.lsb32
    val targetArr:      Array[Byte] = targetSeqList.flatten.toArray

    val reqArr: Array[Byte] = payloadArr ++ targetCountArr ++ targetArr

    sendRaw(reqArr) map { resArr =>
      resizeTargetList zip parseRes(resArr) toMap
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

  private def resizeTargetToBA(rt: ResizeTarget): Array[Byte] =
    rt.width.lsb32 ++ rt.height.lsb32 ++ rt.depth.lsb32 ++ rt.format.name.nullTerm(5)

  private implicit class RichString(s: String) {
    def nullTerm(length: Int): Array[Byte] = {
      require(s.length > length, "Specified length must be greater then string length")
      val padding = s.length - length
      s.getBytes("UTF-8").padTo(padding, 0.toByte)
    }
  }

  private implicit class RichInt(i: Int) {
    def lsb32: Array[Byte] =
      ByteBuffer
        .allocate(JInt.SIZE / JByte.SIZE)
        .order(ByteOrder.LITTLE_ENDIAN)
        .putInt(i)
        .array
  }
}
