using System.IdentityModel.Policy;
using Autofac;

namespace EmajliramoKade
{
	public class SecurityConfiguration : Autofac.Module
	{
		protected override void Load(Autofac.ContainerBuilder builder)
		{
			builder.RegisterType<ModerationAuthorizationPolicy>().As<IAuthorizationPolicy>();
			builder.RegisterType<ModerationAuthentication>().As<IModerationAuthentication>();
			base.Load(builder);
		}
	}
}