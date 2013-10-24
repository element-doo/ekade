using System;
using System.IdentityModel.Selectors;
using System.Security.Cryptography;
using System.ServiceModel;
using System.Text;
using Autofac;
using Autofac.Integration.Wcf;
using NGS.DomainPatterns;
using Sigurnost;

namespace KadaService.Security
{
	public class AuthentificationValidator: UserNamePasswordValidator
	{
		private readonly IRepository<Korisnik> Korisnici = AutofacServiceHostFactory.Container.Resolve<IRepository<Korisnik>>();

		public override void Validate(string userName, string password)
		{
			if (userName == null || password == null)
				throw new ArgumentNullException();

			var korisnik = Korisnici.Find(userName);
			if (korisnik == null)
				throw new FaultException("Authentifikacija neuspijela.");

			password += korisnik.salt;
			var sha1 = new SHA1CryptoServiceProvider();
			var sha1Pwd = sha1.ComputeHash(Encoding.UTF8.GetBytes(password));

			if (sha1Pwd != korisnik.hashSifra)
				throw new FaultException("Authentifikacija neuspijela.");
		}
	}
}