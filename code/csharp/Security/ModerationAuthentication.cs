using System.Diagnostics.Contracts;
using System.Linq;
using System.Runtime.InteropServices;
using System.Security;
using System.Security.Cryptography;
using System.Text;
using NGS.DomainPatterns;
using NGS.Extensibility;
using Sigurnost;

namespace EmajliramoKade
{
	public interface IModerationAuthentication
	{
		bool IsAuthenticated(string user, SecureString password);
	}
		
	public class ModerationAuthentication : IModerationAuthentication
	{
		private readonly IDataCache<Korisnik> Repository;

		public ModerationAuthentication(IObjectFactory factory)
		{
			Contract.Requires(factory != null);

			this.Repository = factory.Resolve<IDataCache<Korisnik>>();
		}

		public bool IsAuthenticated(string user, SecureString password)
		{
			var korisnik = Repository.Find(user);
			if (korisnik == null)
				return false;

			foreach (var @char in korisnik.salt)
				password.AppendChar(@char);

			var sha1 = new SHA1CryptoServiceProvider();
			var sha1Pwd = sha1.ComputeHash(Encoding.UTF8.GetBytes(Marshal.PtrToStringBSTR(Marshal.SecureStringToBSTR(password))));

			if (!korisnik.hashSifra.SequenceEqual(sha1Pwd))
				return false;

			return true;
		}
	}
}
