package com.emajliramokade.api.model.PopisKada.repositories;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;

public class KadaIzvorPodatakaRepository
        extends
        ClientRepository<com.emajliramokade.api.model.PopisKada.KadaIzvorPodataka> {
    public KadaIzvorPodatakaRepository(
            final ServiceLocator locator) {
        super(com.emajliramokade.api.model.PopisKada.KadaIzvorPodataka.class,
                locator);
    }

    public KadaIzvorPodatakaRepository() {
        this(Bootstrap.getLocator());
    }
}
