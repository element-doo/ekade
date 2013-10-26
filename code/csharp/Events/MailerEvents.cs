
using Mailer;
using NGS.DomainPatterns;
using NGS.Features.Mailer;
using System.Net.Mail;
using System.Text;
using System.Net.Mime;
using System.IO;

namespace EmajliramoKade
{
	public class MailerEvents: IDomainEventHandler<SendEmail>
	{
		private readonly IMailService MailService;

		public MailerEvents(IMailService mailService)
		{
			this.MailService = mailService;
		}

		public void Handle(SendEmail domainEvent)
		{
			var mail = new MailMessage();
			mail.From = new MailAddress(domainEvent.from);

			foreach (var email in domainEvent.to)
				mail.To.Add(email);

			foreach (var replyTo in domainEvent.replyTo)
				mail.ReplyToList.Add(replyTo);

			foreach (var cc in domainEvent.cc)
				mail.CC.Add(cc);

			foreach (var bcc in domainEvent.bcc)
				mail.Bcc.Add(bcc);

			mail.Subject = domainEvent.subject;
			mail.Body = domainEvent.textBody;
			mail.BodyEncoding = Encoding.UTF8;

			var view = AlternateView.CreateAlternateViewFromString(domainEvent.htmlBody, Encoding.UTF8, MediaTypeNames.Text.Html);
			foreach (var attachment in domainEvent.attachments)
			{
				var ms = new MemoryStream(attachment.bytes);
				var res = new LinkedResource(ms, attachment.mimeType);
				res.ContentId = attachment.fileName;

				view.LinkedResources.Add(res);
			}

			mail.AlternateViews.Add(view);
			MailService.Queue(mail);
		}
	}
}