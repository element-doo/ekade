package com.emajliramokade
package email

import scala.xml.Elem
import scalax.file.Path

object Email {
  def apply(from: From, to: To, subject: Subject): Email =
    Email(from, Seq(to), Nil, Nil, Nil, subject, None, None, Nil)

  import org.apache.commons.codec.binary.Base64

  private def b64encode(bytes: Array[Byte]): String =
    new String(Base64.encodeBase64Chunked(bytes), Encoding).trim
}

case class Email(
    from: From
  , to: Seq[To]
  , replyTo: Seq[ReplyTo]
  , cc: Seq[CC]
  , bcc: Seq[BCC]
  , subject: Subject
  , textBody: Option[TextBody]
  , htmlBody: Option[HtmlBody]
  , attachments: Seq[Attachment]) extends xml.EmailXMLConverter {

  def add(cc: CC, otherCCs: CC*): Email  =
    copy(cc = this.cc.:+(cc) ++ otherCCs)

  def add(bcc: BCC, otherBCCs: BCC*): Email  =
    copy(bcc = this.bcc.:+(bcc) ++ otherBCCs)

  def add(replyTo: ReplyTo, otherReplyTos: ReplyTo*): Email  =
    copy(replyTo = this.replyTo.:+(replyTo) ++ otherReplyTos)

  def addCC(cc: String, otherCCs: String*): Email  =
    add(CC(cc), otherCCs.map(CC(_)): _*)

  def addBCC(bcc: String, otherBCCs: String*): Email  =
    add(BCC(bcc), otherBCCs.map(BCC(_)): _*)

  def addReplyTo(replyTo: String, otherReplyTos: String*): Email  =
    add(ReplyTo(replyTo), otherReplyTos.map(ReplyTo(_)): _*)

  def setBody(textBody: TextBody): Email  =
    copy(textBody = Some(textBody))

  def setBody(htmlBody: HtmlBody): Email  =
    copy(htmlBody = Some(htmlBody))

  def setBody(xhtmlBody: XHtmlBody): Email  =
    copy(htmlBody = Some(HtmlBody(xhtmlBody.toString)))

  def setTextBody(textBody: String): Email  =
    setBody(TextBody(textBody))

  def setHtmlBody(htmlBody: String): Email  =
    setBody(HtmlBody(htmlBody))

  def setXHtmlBody(xhtmlBody: Elem): Email  =
    setBody(XHtmlBody(xhtmlBody))

  def addAttachment(attachment: Attachment) =
    copy(attachments = this.attachments :+ attachment)

  def addAttachment(path: Path): Email =
    addAttachment(Attachment(path))

  def addAttachment(filename: String, content: Array[Byte]): Email =
    addAttachment(Attachment(filename, content))

  def addAttachment(filename: String, mimeType: String, content: Array[Byte]): Email =
    addAttachment(Attachment(filename, mimeType, content))
}
