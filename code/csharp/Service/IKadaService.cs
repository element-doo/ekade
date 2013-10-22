using System.IO;
using System.ServiceModel;
using System.ServiceModel.Web;

namespace EmajliramoKade
{
	[ServiceContract(Namespace="http://emajliramokade.com")]
	public interface IKadaService
	{
		[OperationContract]
		[WebInvoke(Method = "PUT", UriTemplate = "odobri-kadu/{uri}") ]
		Stream OdobriKadu(string uri);

		[OperationContract]
		[WebInvoke(Method = "PUT", UriTemplate = "dodaj-kadu/{uri}")]
		Stream DodajKadu(string uri, Stream body);

		[OperationContract]
		[WebInvoke(Method = "odbij-kadu/{uri}")]
		Stream OdbijKadu(string uri);

		[OperationContract]
		[WebInvoke(Method = "PosaljiKadu/{uri}")]
		Stream PosaljiKadu(string uri);
	}
}
