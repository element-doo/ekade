module PopisKada
{
  // Aggregate root koji reprezentira entitet kade, sa propertyjima potrebnim za obradu  
  root Kada(ID) {
    Guid       ID;
    Timestamp  dodana { Sequence; }
    Timestamp? odobrena;
    Timestamp? odbijena;
    Int        brojacSlanja;
    String?    komentar;
    
    detail slikeKade Resursi.SlikeKade.kada;
    persistence { optimistic concurrency; }
  }

  mixin KadaEvent {
    Guid kadaID;
  }

  // Ovaj event stvara kadu, definiranu Guidom na strani onoga koji je poslao event
  // Ovo omogućuje konkurentno stvaranje svih loosly-coupled reprezentacija kade
  event KadaDodana {
    has mixin KadaEvent;
    String? komentar;
  }
  
  // Odobravanje kade postavlja "odobrena" timestamp agregata na trenutačno vrijeme
  // Kada koja je odobrena može biti prikazana na public stranici  
  event KadaOdobrena {
    has mixin KadaEvent;
  }

  // Odbijanje kade postavlja "odbijena" timestamp agregata na trenutačno vrijeme
  // Kada koja je odobrena može naknadno biti odbijena
  // Odbijanje kade ne briše agregat iz baze, ali se eksterni storage može smatrati invalidiranim
  event KadaOdbijena {
    has mixin KadaEvent;
  }

  // Slanje kade atomski povećava "brojacSlanja"
  event KadaPoslana {
    has mixin KadaEvent;
  }

  // Izvor podataka se koristi na dva načina
  // Nemoderirane kade je view u kade koje ćekaju review (odobrenje/odbijenicu)
  // Odobrene kade su one nad kojima radimo public view i statistike
  snowflake KadaIzvorPodataka from Kada {
    odobrena;
    odbijena;
    brojacSlanja;
    dodana;

    specification NemoderiraneKade 'it => it.odobrena == null && it.odbijena == null';
    specification OdobreneKade 'it => it.odobrena != null';

    order by brojacSlanja desc, dodana desc;
  }
}
