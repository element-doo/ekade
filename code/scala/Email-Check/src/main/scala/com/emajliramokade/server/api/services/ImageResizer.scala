package com.emajliramokade.services

import scala.concurrent.Future
import hr.element.onebyseven.common.MimeType

case class ResizeTarget(
    width: Int
  , height: Int
  , depth: Short
  , format: MimeType
  )

trait ImageResizer {
  def resize(
    original: Array[Byte]
  , resizeTargetList: Seq[ResizeTarget]
  ): Future[Map[ResizeTarget, Array[Byte]]]
}
