package com.emajliramokade
package email

case class Attachment(
    filename: String
  , mimeType: String
  , bytes: Array[Byte]) extends xml.AttachmentXMLConverter

import scalax.file.Path

object Attachment {
  def apply(path: Path): Attachment =
    Attachment(path.name, path.byteArray)

  def apply(filename: String, content: Array[Byte]): Attachment =
    Attachment(filename, MimeType.fromFileName(filename), content)
}

object MimeType {
  import hr.element.onebyseven.common.{ MimeType => Mimes }

  private val Default = Mimes.BIN

  def fromFileName(filename: String) =
    (filename lastIndexOf '.' match {
      case x if x > 0 =>
        val ext = filename substring (x + 1) toLowerCase;
        Option(Mimes findByExtension ext) getOrElse Default

      case _ =>
        Default
    }).mimeType
}
