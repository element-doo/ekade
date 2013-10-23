package com.emajliramokade
package email.services

import hr.element.onebyseven.common.MimeType
import scala.concurrent.Future

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
