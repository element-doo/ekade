using System.IO;
using System.ServiceModel;
using System.ServiceModel.Web;

namespace EmajliramoKade
{
	[ServiceContract(Namespace="http://emajliramokade.com")]
	public interface IModerirajService
	{
		[OperationContract]
		[WebInvoke(Method = "PUT", UriTemplate = "KadaOdobrena/{uri}") ]
		Stream OdobriKadu(string uri);

		[OperationContract]
		[WebInvoke(Method = "PUT", UriTemplate = "KadaOdbijena/{uri}")]
		Stream OdbijKadu(string uri);

		[OperationContract]
		[WebInvoke(Method = "GET", UriTemplate = "KadaIzvorPodataka/NemoderiraneKade?offset={offset}&limit={limit}")]
		Stream DajKade(int offset, int limit);

		[OperationContract]
		[WebInvoke(Method = "PUT", UriTemplate = "MasovnaModeracija")]
		Stream MasovnaModeracija(Stream body);
	}
}
