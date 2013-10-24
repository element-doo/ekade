module ImageLoad
{
  value Zahtjev {
    GUID    kadaID;
    String  tipSlike;
  }

  value Odgovor {
    Resursi.PodaciSlike  podaciSlike;
    Binary               body;
  }
}
