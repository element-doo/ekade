package com.emajliramokade.api.model.Resursi.repositories;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;

public class MaxDimenzijeRepository
        extends
        ClientPersistableRepository<com.emajliramokade.api.model.Resursi.MaxDimenzije> {
    public MaxDimenzijeRepository(
            final ServiceLocator locator) {
        super(com.emajliramokade.api.model.Resursi.MaxDimenzije.class, locator);
    }
}
