using System.IdentityModel.Selectors;
using System.Security;
using System.ServiceModel;
using Autofac;
using Autofac.Integration.Wcf;

namespace EmajliramoKade
{
	public class ModerationLoginValidator : UserNamePasswordValidator
	{
		private readonly IModerationAuthentication Authentication = AutofacServiceHostFactory.Container.Resolve<IModerationAuthentication>();

		public override void Validate(string userName, string password)
		{
			var secure = new SecureString();
			if (password != null)
				foreach (var p in password)
					secure.AppendChar(p);
			if (!Authentication.IsAuthenticated(userName, secure))
				throw new FaultException("Tralalala");
		}
	}
}