using System;
using System.IO;
using System.Linq;
using System.Net;
using System.ServiceModel.Web;
using System.Text;
using NGS.DomainPatterns;
using PopisKada;

namespace EmajliramoKade
{
	public class ModerirajService : ServiceHelper, IModerirajService
	{
		private readonly IServiceLocator Locator;
		private readonly IPersistableRepository<Kada> Kade;
		private readonly IQueryableRepository<KadaIzvorPodataka> KadaIzvorPodataka;

		public ModerirajService(IServiceLocator locator)
		{
			this.Locator = locator;
			this.Kade = locator.Resolve<IPersistableRepository<Kada>>();
			this.KadaIzvorPodataka = locator.Resolve<IPersistableRepository<KadaIzvorPodataka>>();
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

		//TODO: Implement
		public Stream DodajKadu(string guid, Stream komentar)
		{
			var @event = new KadaDodana();
			return Execute(guid, @event);
		}





		public Stream DajKade(int offset, int limit)
		{
			limit = limit == 0 ? 100 : Math.Min(limit, 100);

			var kade = KadaIzvorPodataka.Query(new KadaIzvorPodataka.NemoderiraneKade()).Skip(offset).Take(limit).ToList();
			return Serialize(Locator, kade);
		}
	}
}