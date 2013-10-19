module Api
{
  value Zahtjev {
    String  email;
    String? kadaID;
  }

  value Odgovor {
    Boolean  status;
    String   poruka;
  }
}
