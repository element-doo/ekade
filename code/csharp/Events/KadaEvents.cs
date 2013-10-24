using System;
using System.Linq;
using System.Threading;
using NGS.DomainPatterns;
using PopisKada;
using Resursi;

namespace EmajliramoKade
{
	public class KadaEvents:
		IDomainEventHandler<KadaDodana>,
		IDomainEventHandler<KadaOdobrena>,
		IDomainEventHandler<KadaOdbijena>,
		IDomainEventHandler<KadaPoslana>,
		IDomainEventHandler<MasovnaModeracija>
	{
		private readonly IPersistableRepository<Kada> Kade;
		private readonly IPersistableRepository<SlikeKade> SlikeKade;

		public KadaEvents(
			IPersistableRepository<Kada> kade,
			IPersistableRepository<SlikeKade> slikeKade)
		{
			this.Kade = kade;
			this.SlikeKade = slikeKade;
		}

		private void Execute(Guid guid, Action<Kada> callback, int counter = 0)
		{
			try
			{
				var kada = Kade.Find(guid.ToString());
				if (kada == null)
					throw new ArgumentException("Kada sa GUID-om '" + guid.ToString() + "' ne postoji!");

				callback(kada);
				Kade.Update(kada);
			}
			catch
			{
				if (counter < 5)
				{
					Thread.Sleep(25);
					Execute(guid, callback, counter + 1);
				}
			}
		}

		public void Handle(KadaDodana domainEvent)
		{
			Execute(domainEvent.kadaID, kada => {
				SlikeKade.Insert(new SlikeKade
				{
					kada = kada,
					original = domainEvent.original,
					web = domainEvent.web,
					email = domainEvent.email,
					thumbnail = domainEvent.thumbnail
				});
			});
		}

		public void Handle(KadaOdobrena domainEvent)
		{
			Execute(domainEvent.kadaID, kada =>
				kada.odobrena = DateTime.UtcNow
			);
		}

		public void Handle(KadaOdbijena domainEvent)
		{
			Execute(domainEvent.kadaID, kada =>
				kada.odbijena = DateTime.UtcNow
			);
		}

		public void Handle(KadaPoslana domainEvent)
		{
			Execute(domainEvent.kadaID, kada =>
				kada.brojacSlanja++
			);
		}

		public void Handle(MasovnaModeracija domainEvent)
		{
			var kadeID = domainEvent.moderacijeKada.Select(it => it.kadaID.ToString());
			var kade = Kade.Find(kadeID).ToDictionary(it => it.ID, it => it);

			foreach (var kada in domainEvent.moderacijeKada)
			{
				if (kada.odobrena)
					kade[kada.kadaID].odobrena = DateTime.Now;
				else
					kade[kada.kadaID].odbijena = DateTime.Now;
			}

			Kade.Update(kade.Values);
		}
	}
}