﻿module Mailer 
{
  event SendEmail {
    String    from;
    String[]  to;
    String[]  replyTo;
    String[]  cc;
    String[]  bcc;
    String    subject;
    String?   textBody;
    String?   htmlBody;
    
    Attachment[] attachments;
  }

  value Attachment {
    String fileName;
    String mimeType;
    Binary bytes;
  }

  guid root MailMessage {
      native<'NGS.Features.Mailer.Serialization.SerializableMailMessage, NGS.Features.Mailer'> Message;

      timestamp? SentAt;
      int Attempts;
      int RetriesAllowed;
      string[] Errors;

      implements 'NGS.Features.Mailer.IMailMessage, NGS.Features.Mailer';
    }
  }

  register server Mailer.MailService as NGS.Features.Mailer.IMailService;

  server code <#
  namespace Mailer
  {
    using NGS.DomainPatterns;
    using NGS.Features.Mailer;

    public class MailService : NGS.Features.Mailer.MailService
    {
      private readonly IPersistableRepository<MailMessage> Repository;

      public MailService(IServiceLocator locator)
        : base(locator)
      {
        Repository = locator.Resolve<IPersistableRepository<MailMessage>>();
      }

      protected override IMailMessage Create() { return new MailMessage { RetriesAllowed = 3 }; }
      protected override string Insert(IMailMessage msg) { return Repository.Insert((MailMessage)msg); }
      protected override void Update(IMailMessage msg) { Repository.Update((MailMessage)msg); }
    }
  }
  #>;
}