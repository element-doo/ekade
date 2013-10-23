package com.emajliramokade.api.model.PopisKada;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;

public final class KadaOdbijena
        implements
        DomainEvent,
        java.io.Serializable,
        com.emajliramokade.api.model.PopisKada.KadaEvent<com.emajliramokade.api.model.PopisKada.KadaOdbijena> {
    public KadaOdbijena(
            final java.util.UUID kadaID) {
        setKadaID(kadaID);
    }

    public KadaOdbijena() {
        this.kadaID = java.util.UUID.randomUUID();
    }

    private String URI;

    public String getURI() {
        return this.URI;
    }

    @Override
    public int hashCode() {
        return URI != null ? URI.hashCode() : super.hashCode();
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (getClass() != obj.getClass()) return false;
        final KadaOdbijena other = (KadaOdbijena) obj;

        return URI != null && URI.equals(other.URI);
    }

    @Override
    public String toString() {
        return URI != null ? "KadaOdbijena(" + URI + ')' : "new KadaOdbijena("
                + super.hashCode() + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private java.util.UUID kadaID;

    public java.util.UUID getKadaID() {
        return kadaID;
    }

    public KadaOdbijena setKadaID(final java.util.UUID value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"kadaID\" cannot be null!");
        this.kadaID = value;

        return this;
    }

    public String submit() throws java.io.IOException {
        return submit(Bootstrap.getLocator());
    }

    public String submit(final ServiceLocator locator)
            throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class).submit(this).get();
        } catch (InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }
}
