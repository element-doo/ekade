package com.emajliramokade
package email
package xml

import hr.element.etb.Pimps._
import scala.xml.NodeSeq

import org.apache.commons.codec.binary.Base64

private object AttachmentXMLConverter

trait AttachmentXMLConverter extends XMLConverter { this: Attachment =>
  def toXml =
AttachmentXMLConverter.synchronized(
<Attachment>
  <fileName>{ filename }</fileName>
  <mimeType>{ mimeType }</mimeType>
  <content>{ Base64.encodeBase64String(bytes).trim }</content>
</Attachment>.prettyPrint)
}
