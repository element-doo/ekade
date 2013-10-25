using System;
using System.Security.Cryptography;
using System.Text;
using NGS.DomainPatterns;
using Sigurnost;

namespace EmajliramoKade
{
	public class SigurnostEvents: IDomainEventHandler<Registracija>
	{
		private readonly IPersistableRepository<Korisnik> Korisnici;

		public SigurnostEvents(IPersistableRepository<Korisnik> korisnici)
		{
			this.Korisnici = korisnici;
		}

		public void Handle(Registracija domainEvent)
		{
			var salt = Guid.NewGuid().ToString().Replace("-", "").Substring(10, 15);
			var sifra = domainEvent.sifra + salt;

			var sha1 = new SHA1CryptoServiceProvider();
			var korisnik = new Korisnik
			{
				username  = domainEvent.username,
				hashSifra = sha1.ComputeHash(Encoding.UTF8.GetBytes(sifra)),
				salt      = salt
			};

			Korisnici.Insert(korisnik);
		}
	}
}