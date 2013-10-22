using System;
using System.IO;
using System.Net;
using System.ServiceModel.Web;
using System.Text;
using NGS.DomainPatterns;
using PopisKada;

namespace EmajliramoKade
{
	public class KadaService : IKadaService
	{
		private readonly IServiceLocator Locator;
		private readonly IPersistableRepository<PopisKada.Kada> Kade;

		public KadaService(IServiceLocator locator)
		{
			this.Locator = locator;
			this.Kade = locator.Resolve<IPersistableRepository<PopisKada.Kada>>();
		}

		private Stream Execute<TEvent>(string guid, TEvent @event, Action callback = null)
			where TEvent: KadaEvent, IDomainEvent
		{
			try
			{
				@event.kadaID = new Guid(guid);
				if (callback != null)
					callback();
				@event.Process(Locator);
				return new MemoryStream(0);
			}
			catch (ArgumentException e)
			{
				WebOperationContext.Current.OutgoingResponse.StatusCode = HttpStatusCode.BadRequest;
				return new MemoryStream(Encoding.UTF8.GetBytes(e.Message));
			}
			catch (Exception e)
			{
				WebOperationContext.Current.OutgoingResponse.StatusCode = HttpStatusCode.InternalServerError;
				return new MemoryStream(Encoding.UTF8.GetBytes(e.Message));
			}
		}

		public Stream OdobriKadu(string guid)
		{
			return Execute(guid, new KadaOdobrena());
		}

		public Stream PosaljiKadu(string guid)
		{
			return Execute(guid, new KadaPoslana());
		}

		public Stream OdbijKadu(string guid)
		{
			return Execute(guid, new KadaOdbijena());
		}

		public Stream DodajKadu(string guid, Stream komentar)
		{
			var @event = new KadaDodana();
			return Execute(guid, @event, () =>
				@event.komentar = new StreamReader(komentar).ReadToEnd()
			);
		}
	}
}