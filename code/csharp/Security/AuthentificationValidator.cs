using System;
using System.IdentityModel.Selectors;

namespace KadaService.Security
{
	public class AuthentificationValidator: UserNamePasswordValidator
	{
		public override void Validate(string userName, string password)
		{
			if (userName == null || password = null)
				throw new ArgumentNullException();


		}
	}
}