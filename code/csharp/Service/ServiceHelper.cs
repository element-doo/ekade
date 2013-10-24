using System;
using System.IO;
using System.Runtime.Serialization;
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

			var ms = new MemoryStream();
			WebOperationContext.Current.OutgoingResponse.ContentType = "application/xml";
			xmlSerialization.Serialize(Object).Save(ms);
			return ms;
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

		protected T DeserializeJson<T>(IServiceLocator locator, Stream body)
		{
			var jsonSerialization = locator.Resolve<ISerialization<StreamReader>>();
			var sr = new StreamReader(body);
			return jsonSerialization.Deserialize<T>(sr, new StreamingContext(StreamingContextStates.All));
		}

		protected T DeserializeXml<T>(IServiceLocator locator, Stream body)
		{
			var jsonSerialization = locator.Resolve<ISerialization<XElement>>();
			var sr = XElement.Load(body);
			return jsonSerialization.Deserialize<T>(sr, new StreamingContext(StreamingContextStates.All));
		}

		protected T DeserializeProtobuf<T>(IServiceLocator locator, Stream body)
		{
			var jsonSerialization = locator.Resolve<ISerialization<Stream>>();
			return jsonSerialization.Deserialize<T>(body, new StreamingContext(StreamingContextStates.All));
		}

		protected T Deserialize<T>(IServiceLocator locator, Stream body)
		{
			var contentType = WebOperationContext.Current.IncomingRequest.ContentType;

			if (contentType.Contains("application/json") || contentType.Contains("text/json"))
				return DeserializeJson<T>(locator, body);

			if (contentType.Contains("application/xml") || contentType.Contains("text/xml"))
				return DeserializeXml<T>(locator, body);

			if (contentType.Contains("application/x-protobuf"))
				return DeserializeProtobuf<T>(locator, body);

			throw new ArgumentException("Ne mogu deserializirati u tip '" + typeof(T).FullName + "'");
		}
	}
}