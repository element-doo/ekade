package com.emajliramokade.api.model.Resursi.repositories;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;

public class SlikeKadeRepository
        extends
        ClientPersistableRepository<com.emajliramokade.api.model.Resursi.SlikeKade> {
    public SlikeKadeRepository(
            final ServiceLocator locator) {
        super(com.emajliramokade.api.model.Resursi.SlikeKade.class, locator);
    }
}
