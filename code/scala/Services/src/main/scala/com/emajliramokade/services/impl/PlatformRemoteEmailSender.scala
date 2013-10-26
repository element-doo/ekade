package com.emajliramokade
package services
package impl

import hr.ngs.patterns.ISerialization
import email.Email
import com.dslplatform.client.DomainProxy
import com.emajliramokade.api.model.Mailer._
import scala.concurrent.Future

class PlatformRemoteEmailSender(
    domainProxy: DomainProxy
  ) {

  def send(email: Email) = Future {
    val sendEmail =
      new SendEmail()
        .setFrom(email.from.email)
        .setTo(email.to.map(_.email).toArray)
        .setReplyTo(email.replyTo.map(_.email).toArray)
        .setCc(email.cc.map(_.email).toArray)
        .setBcc(email.bcc.map(_.email).toArray)
        .setSubject(email.subject.body)
        .setTextBody(email.textBody.map(_.body).orNull)
        .setHtmlBody(email.htmlBody.map(_.body).orNull)
        .setAttachments(email.attachments.toArray.map{ a =>
          new Attachment()
            .setFileName(a.filename)
            .setMimeType(a.mimeType)
            .setBytes(a.bytes)
        })

    domainProxy.submit(sendEmail).get()
  }
}
