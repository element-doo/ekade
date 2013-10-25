module Sigurnost
{
  root Korisnik(username) {
    String  username;
    String  salt;
    Binary  hashSifra;
  }

  event Registracija {
    String username;
    String sifra;
  }
}
