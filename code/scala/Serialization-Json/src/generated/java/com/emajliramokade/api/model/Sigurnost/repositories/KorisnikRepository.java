package com.emajliramokade.api.model.Sigurnost.repositories;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;

public class KorisnikRepository
        extends
        ClientPersistableRepository<com.emajliramokade.api.model.Sigurnost.Korisnik> {
    public KorisnikRepository(
            final ServiceLocator locator) {
        super(com.emajliramokade.api.model.Sigurnost.Korisnik.class, locator);
    }
}
