package com.emajliramokade

import scala.concurrent.duration._

object `package` {
  val Encoding = "UTF-8"
  val ServiceTimeout = 5 seconds

  implicit val executionContext =
    scala.concurrent.ExecutionContext.fromExecutor(
        java.util.concurrent.Executors.newCachedThreadPool())

  implicit class PimpedString(s: String) {
    def toUTF8 =
      s.getBytes(Encoding)
  }

  implicit class PimpedByteArray(ba: Array[Byte]) {
    def fromUTF8 =
      new String(ba, Encoding)
  }
}
