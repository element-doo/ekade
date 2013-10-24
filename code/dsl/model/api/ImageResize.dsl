module ImageResize
{
  value Slika {
    Binary  body;
  }

  value ResizeZahtjev {
    Int     width;
    Int     height;
    Int     depth;
    String  format;
  }

  value Zahtjev {
    Slika                slika;
    List<ResizeZahtjev>  zahtjevi;
  }

  value Odgovor {
    List<Slika>  odgovori;
  }
}
