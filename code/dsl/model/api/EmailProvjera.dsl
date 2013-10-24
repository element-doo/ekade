module EmailProvjera
{
  value Zahtjev {
    String  email;
    GUID?   kadaID;
  }

  value Odgovor {
    Boolean  status;
    String   poruka;
  }
}
