package com.emajliramokade
package email
package xml

import hr.element.etb.Pimps._
import scala.xml.NodeSeq

import org.apache.commons.codec.binary.Base64

trait AttachmentXMLConverter extends XMLConverter { this: Attachment =>
  def toXml =
<Attachment>
  <fileName>{ filename }</fileName>
  <mimeType>{ mimeType }</mimeType>
  <content>{ new String(Base64.encodeBase64Chunked(bytes), Encoding).trim }</content>
</Attachment>.prettyPrint
}
