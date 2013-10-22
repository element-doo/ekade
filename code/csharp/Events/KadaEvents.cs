using System;
using System.Threading;
using NGS.DomainPatterns;
using PopisKada;

namespace EmajliramoKade
{
	public class EmajliramoKadeEvents:
		IDomainEventHandler<KadaDodana>,
		IDomainEventHandler<KadaOdobrena>,
		IDomainEventHandler<KadaOdbijena>,
		IDomainEventHandler<KadaPoslana>
	{
		private readonly IPersistableRepository<Kada> Kade;

		public EmajliramoKadeEvents(IPersistableRepository<Kada> kade)
		{
			this.Kade = kade;
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
			Execute(domainEvent.kadaID, kada =>
				kada.komentar = domainEvent.komentar
			);
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
	}
}