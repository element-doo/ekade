module EmailRegistracija
{
  value Zahtjev {
    String  email;
  }

  value Odgovor {
    Boolean  odjavljen;
    String   unsubscribeID;
  }
}
