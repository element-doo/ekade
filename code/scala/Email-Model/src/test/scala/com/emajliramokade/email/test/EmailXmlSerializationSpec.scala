package com.emajliramokade
package email
package test

import org.junit.runner.RunWith
import org.scalatest._
import org.scalatest.junit.JUnitRunner

@RunWith(classOf[JUnitRunner])
class EmailXmlSerializationSpec
    extends FeatureSpec
    with GivenWhenThen
    with MustMatchers {

  feature("Email XML Serialization") {
    scenario("An Email object can be seralized into XML") {

      val email = (
        Email(
          From("majstor@emajliramokade.com"),
          To("marko@element.hr"),
          Subject("Stigla vam je kada!")
        )
        addBCC("secret@nkvd.su", "tajna@mossad.il")
        setTextBody("Ovo je vaša kada \\_____/")
        setXHtmlBody(<kada>\_____/</kada>)
        addAttachment("OpisKade.txt", "Lijepa." getBytes "UTF-8")
        addAttachment("SchemaKade.xml", "<posuda/>" getBytes "UTF-8")
        addAttachment("SlikaKade.jpg", "JFIF..." getBytes "UTF-8")
      )

      Given("an Email:\n" + email)
      Then("it can be serialized to XML:\n" + email.toXml)

      val emailXml =
<Email>
  <from>majstor@emajliramokade.com</from>
  <subject>Stigla vam je kada!</subject>
  <to>marko@element.hr</to>
  <bcc>secret@nkvd.su</bcc>
  <bcc>tajna@mossad.il</bcc>
  <textBody>Ovo je vaša kada \_____/</textBody>
  <htmlBody>&lt;kada&gt;\_____/&lt;/kada&gt;</htmlBody>
  <attachments>
    <Attachment>
      <fileName>OpisKade.txt</fileName>
      <mimeType>text/plain</mimeType>
      <content>TGlqZXBhLg==</content>
    </Attachment>
    <Attachment>
      <fileName>SchemaKade.xml</fileName>
      <mimeType>application/xml</mimeType>
      <content>PHBvc3VkYS8+</content>
    </Attachment>
    <Attachment>
      <fileName>SlikaKade.jpg</fileName>
      <mimeType>image/jpeg</mimeType>
      <content>SkZJRi4uLg==</content>
    </Attachment>
  </attachments>
</Email>

      val emailString = email.toXml.toString.replaceAll("\t", "  ")
      val xmlString = emailXml.toString

      emailString must equal (xmlString)
    }
  }
}
