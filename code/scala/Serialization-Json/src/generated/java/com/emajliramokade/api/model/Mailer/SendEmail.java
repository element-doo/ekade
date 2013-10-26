package com.emajliramokade.api.model.Mailer;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;

public final class SendEmail implements DomainEvent, java.io.Serializable {
    public SendEmail(
            final String from,
            final String[] to,
            final String[] replyTo,
            final String[] cc,
            final String[] bcc,
            final String subject,
            final String textBody,
            final String htmlBody,
            final com.emajliramokade.api.model.Mailer.Attachment[] attachments) {
        setFrom(from);
        setTo(to);
        setReplyTo(replyTo);
        setCc(cc);
        setBcc(bcc);
        setSubject(subject);
        setTextBody(textBody);
        setHtmlBody(htmlBody);
        setAttachments(attachments);
    }

    public SendEmail() {
        this.from = "";
        this.to = new String[] {};
        this.replyTo = new String[] {};
        this.cc = new String[] {};
        this.bcc = new String[] {};
        this.subject = "";
        this.attachments = new com.emajliramokade.api.model.Mailer.Attachment[0];
    }

    private String URI;

    public String getURI() {
        return this.URI;
    }

    @Override
    public int hashCode() {
        return URI != null ? URI.hashCode() : super.hashCode();
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (getClass() != obj.getClass()) return false;
        final SendEmail other = (SendEmail) obj;

        return URI != null && URI.equals(other.URI);
    }

    @Override
    public String toString() {
        return URI != null ? "SendEmail(" + URI + ')' : "new SendEmail("
                + super.hashCode() + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private String from;

    public String getFrom() {
        return from;
    }

    public SendEmail setFrom(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"from\" cannot be null!");
        this.from = value;

        return this;
    }

    private String[] to;

    public String[] getTo() {
        return to;
    }

    public SendEmail setTo(final String[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"to\" cannot be null!");
        com.emajliramokade.api.model.Guards.checkNulls(value);
        this.to = value;

        return this;
    }

    private String[] replyTo;

    public String[] getReplyTo() {
        return replyTo;
    }

    public SendEmail setReplyTo(final String[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"replyTo\" cannot be null!");
        com.emajliramokade.api.model.Guards.checkNulls(value);
        this.replyTo = value;

        return this;
    }

    private String[] cc;

    public String[] getCc() {
        return cc;
    }

    public SendEmail setCc(final String[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"cc\" cannot be null!");
        com.emajliramokade.api.model.Guards.checkNulls(value);
        this.cc = value;

        return this;
    }

    private String[] bcc;

    public String[] getBcc() {
        return bcc;
    }

    public SendEmail setBcc(final String[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"bcc\" cannot be null!");
        com.emajliramokade.api.model.Guards.checkNulls(value);
        this.bcc = value;

        return this;
    }

    private String subject;

    public String getSubject() {
        return subject;
    }

    public SendEmail setSubject(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"subject\" cannot be null!");
        this.subject = value;

        return this;
    }

    private String textBody;

    public String getTextBody() {
        return textBody;
    }

    public SendEmail setTextBody(final String value) {
        this.textBody = value;

        return this;
    }

    private String htmlBody;

    public String getHtmlBody() {
        return htmlBody;
    }

    public SendEmail setHtmlBody(final String value) {
        this.htmlBody = value;

        return this;
    }

    private com.emajliramokade.api.model.Mailer.Attachment[] attachments;

    public com.emajliramokade.api.model.Mailer.Attachment[] getAttachments() {
        return attachments;
    }

    public SendEmail setAttachments(
            final com.emajliramokade.api.model.Mailer.Attachment[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"attachments\" cannot be null!");
        com.emajliramokade.api.model.Guards.checkNulls(value);
        this.attachments = value;

        return this;
    }

    public String submit() throws java.io.IOException {
        return submit(Bootstrap.getLocator());
    }

    public String submit(final ServiceLocator locator)
            throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class).submit(this).get();
        } catch (InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }
}
