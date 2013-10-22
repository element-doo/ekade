package com.emajliramokade.services

import scala.concurrent.Future

trait ResizeFormat { val name: String }
object ResizeFormat {
  case object JPG  extends ResizeFormat { val name = "jpg" }
  case object TIFF extends ResizeFormat { val name = "tiff" }
  case object BMP  extends ResizeFormat { val name = "bmp" }
}

case class ResizeTarget(width: Int, height: Int, depth: Int, format: ResizeFormat)

trait ImageResizer {
  def resize(original: Array[Byte], resizeTargetList: Seq[ResizeTarget]): Future[Map[(ResizeTarget), Array[Byte]]]
}
