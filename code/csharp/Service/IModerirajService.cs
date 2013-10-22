using System.IO;
using System.ServiceModel;
using System.ServiceModel.Web;

namespace EmajliramoKade
{
	[ServiceContract(Namespace="http://emajliramokade.com")]
	public interface IModerirajService
	{
		[OperationContract]
		[WebInvoke(Method = "PUT", UriTemplate = "odobri-kadu/{uri}") ]
		Stream OdobriKadu(string uri);

		[OperationContract]
		[WebInvoke(Method = "PUT", UriTemplate = "dodaj-kadu/{uri}")]
		Stream DodajKadu(string uri, Stream body);

		[OperationContract]
		[WebInvoke(Method = "PUT", UriTemplate = "odbij-kadu/{uri}")]
		Stream OdbijKadu(string uri);

		[OperationContract]
		[WebInvoke(Method = "PUT", UriTemplate = "posalji-kadu/{uri}")]
		Stream PosaljiKadu(string uri);

		[OperationContract]
		[WebInvoke(Method = "GET", UriTemplate = "daj-kade?offset={offset}&limit={limit}")]
		Stream DajKade(int offset, int limit);
	}
}
