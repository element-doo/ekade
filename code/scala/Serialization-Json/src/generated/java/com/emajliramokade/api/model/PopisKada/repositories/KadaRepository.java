package com.emajliramokade.api.model.PopisKada.repositories;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;

public class KadaRepository
        extends
        ClientPersistableRepository<com.emajliramokade.api.model.PopisKada.Kada> {
    public KadaRepository(
            final ServiceLocator locator) {
        super(com.emajliramokade.api.model.PopisKada.Kada.class, locator);
    }
}
