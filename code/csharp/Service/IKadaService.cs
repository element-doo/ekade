using System.IO;
using System.ServiceModel;
using System.ServiceModel.Web;

namespace EmajliramoKade
{
	[ServiceContract(Namespace = "http://emajliramokade.com")]
	public interface IKadaService
	{
		[OperationContract]
		[WebInvoke(Method = "GET", UriTemplate = "KadaIzvorPodataka/OdobreneKade?offset={offset}&limit={limit}")]
		Stream OdobreneKade(int offset, int limit);

		[OperationContract]
		[WebInvoke(Method = "PUT", UriTemplate = "SendMail")]
		Stream SendMail(Stream body);
	}
}
