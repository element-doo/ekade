using System;
using System.Collections.Generic;
using System.Configuration;
using System.IdentityModel.Claims;
using System.IdentityModel.Policy;
using System.Net;
using System.Security;
using System.Security.Principal;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;
using System.Threading;
using Autofac;
using Autofac.Integration.Wcf;
using NGS.Server.Api;

namespace EmajliramoKade
{
	public class ModerationAuthorizationPolicy : IAuthorizationPolicy
	{
		private static readonly string DefaultAuthorization = ConfigurationManager.AppSettings["DefaultAuthorization"];
		private readonly IModerationAuthentication Authentication = AutofacHostFactory.Container.Resolve<IModerationAuthentication>();

		public bool Evaluate(EvaluationContext evaluationContext, ref object state)
		{
			var client = GetClientIdentity(evaluationContext);

			evaluationContext.Properties["Principal"] = Thread.CurrentPrincipal;
			return true;
		}

		private class RestIdentity : IIdentity
		{
			public string AuthenticationType { get; internal set; }
			public bool IsAuthenticated { get; internal set; }
			public string Name { get; internal set; }
		}

		private IIdentity GetClientIdentity(EvaluationContext evaluationContext)
		{
			object obj;
			if (!evaluationContext.Properties.TryGetValue("Identities", out obj))
			{
				var authorization = WebOperationContext.Current.IncomingRequest.Headers[HttpRequestHeader.Authorization] ?? DefaultAuthorization;
				if (authorization == null)
				{
					WebOperationContext.Current.OutgoingResponse.Headers["WWW-Authenticate"] = "Basic realm=\"site\"";
					Utility.ThrowError("Authorization header not provided.", HttpStatusCode.Unauthorized);
				}

				var splt = authorization.Split(' ');
				var authType = splt[0];
				if (splt.Length != 2)
					Utility.ThrowError("Invalid authorization header.", HttpStatusCode.Unauthorized);

				var cred = Encoding.UTF8.GetString(Convert.FromBase64String(splt[1])).Split(':');
				if (cred.Length != 2)
					Utility.ThrowError("Invalid authorization header content.", HttpStatusCode.Unauthorized);

				var user = cred[0];
				var password = new SecureString();
				foreach (var c in cred[1])
					password.AppendChar(c);

				if (string.IsNullOrEmpty(user))
					Utility.ThrowError("User not specified in authorization header.", HttpStatusCode.Unauthorized);

				var identity = new RestIdentity
				{
					AuthenticationType = authType,
					IsAuthenticated = Authentication.IsAuthenticated(user, password),
					Name = user
				};
				var template = WebOperationContext.Current.IncomingRequest.UriTemplateMatch;
				if (!identity.IsAuthenticated)
				{
					Utility.ThrowError("User '" + user + "' was not authenticated.", HttpStatusCode.Forbidden);
				}
				else if (template == null)
				{
					var url = OperationContext.Current.RequestContext.RequestMessage.Headers.To;
					Utility.ThrowError("Unknown route: " + url.PathAndQuery, HttpStatusCode.NotFound);
				}
				return identity;
			}

			var identities = obj as IList<IIdentity>;
			if (identities == null || identities.Count < 1)
				Utility.ThrowError("No Identity found.", HttpStatusCode.Unauthorized);

			return identities[0];
		}

		public ClaimSet Issuer { get { return ClaimSet.System; } }
		public string Id { get; private set; }
	}
}
