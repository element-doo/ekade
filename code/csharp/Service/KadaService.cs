using System;
using System.IO;
using System.Linq;
using NGS.DomainPatterns;
using PopisKada;

namespace EmajliramoKade
{
	public class KadaService: ServiceHelper, IKadaService
	{
		private readonly IServiceLocator Locator;
		private readonly IQueryableRepository<KadaIzvorPodataka> Kade;

		public KadaService(IServiceLocator locator)
		{
			this.Locator = locator;
			this.Kade = locator.Resolve<IQueryableRepository<KadaIzvorPodataka>>();
		}

		public Stream OdobreneKade(int offset, int limit)
		{
			limit = limit == 0 ? 100 : Math.Min(limit, 100);

			var kade = Kade.Query(new KadaIzvorPodataka.OdobreneKade()).Skip(offset).Take(limit).ToList();
			return Serialize(Locator, kade);
		}
	}
}