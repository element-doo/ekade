module ImageProvjera
{
  value Zahtjev {
    Int     velicinaSlike;
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
