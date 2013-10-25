module ImageSave
{
  value Zahtjev {
    GUID    kadaID;
    Binary  thumbnail;
    Binary  original;
    Binary  email;
    Binary  web;
  }

  // do not underestimate the power of a type-safe void!
  value Odgovor;
}
