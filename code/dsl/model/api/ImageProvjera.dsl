module ImageProvjera
{
  value Zahtjev {
    Binary  originalnaSlika;
  }

  value DimenzijeSlike {
    Int  width;
    Int  height;
  }

  value Odgovor {
    Boolean         status;
    String          poruka;
    DimenzijeSlike? dimenzijeSlike;
  }
}
