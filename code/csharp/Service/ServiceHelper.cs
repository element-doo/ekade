using System;
using System.IO;
using System.ServiceModel.Web;
using System.Xml.Linq;
using NGS.DomainPatterns;
using NGS.Serialization;

namespace EmajliramoKade
{
	public abstract class ServiceHelper
	{
		protected Stream SerializeJson<T>(IServiceLocator locator, T Object)
		{
			var jsonSerialization = locator.Resolve<ISerialization<StreamReader>>();

			WebOperationContext.Current.OutgoingResponse.ContentType = "application/json";
			return jsonSerialization.Serialize(Object).BaseStream;
		}

		protected Stream SerializeXml<T>(IServiceLocator locator, T Object)
		{
			var xmlSerialization = locator.Resolve<ISerialization<XElement>>();	

			using (var ms = new MemoryStream())
			{
				WebOperationContext.Current.OutgoingResponse.ContentType = "application/xml";
				xmlSerialization.Serialize(Object).Save(ms);
				return ms;
			}
		}

		protected Stream SerializeProtobuf<T>(IServiceLocator locator, T Object)
		{
			var protobufSerialization = locator.Resolve<ISerialization<MemoryStream>>();

			WebOperationContext.Current.OutgoingResponse.ContentType = "application/x-protobuf";
			return protobufSerialization.Serialize(Object);
		}

		protected Stream Serialize<T>(IServiceLocator locator, T Object)
		{
			var accept = WebOperationContext.Current.IncomingRequest.Accept;

			if (accept.Contains("application/json") || accept.Contains("text/json"))
				return SerializeJson(locator, Object);

			if (accept.Contains("application/xml") || accept.Contains("text/xml"))
				return SerializeXml(locator, Object);

			if (accept.Contains("application/x-protobuf"))
				return SerializeProtobuf(locator, Object);

			throw new ArgumentException("Ne mogu serializirati u tip '" + accept + "'");
		}
	}
}