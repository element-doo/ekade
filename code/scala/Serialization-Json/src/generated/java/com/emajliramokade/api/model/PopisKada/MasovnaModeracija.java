package com.emajliramokade.api.model.PopisKada;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;

public final class MasovnaModeracija implements DomainEvent,
        java.io.Serializable {
    public MasovnaModeracija(
            final java.util.List<com.emajliramokade.api.model.PopisKada.ModeriranaKada> moderacijeKada) {
        setModeracijeKada(moderacijeKada);
    }

    public MasovnaModeracija() {
        this.moderacijeKada = new java.util.ArrayList<com.emajliramokade.api.model.PopisKada.ModeriranaKada>();
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
        final MasovnaModeracija other = (MasovnaModeracija) obj;

        return URI != null && URI.equals(other.URI);
    }

    @Override
    public String toString() {
        return URI != null
                ? "MasovnaModeracija(" + URI + ')'
                : "new MasovnaModeracija(" + super.hashCode() + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private java.util.List<com.emajliramokade.api.model.PopisKada.ModeriranaKada> moderacijeKada;

    public java.util.List<com.emajliramokade.api.model.PopisKada.ModeriranaKada> getModeracijeKada() {
        return moderacijeKada;
    }

    public MasovnaModeracija setModeracijeKada(
            final java.util.List<com.emajliramokade.api.model.PopisKada.ModeriranaKada> value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"moderacijeKada\" cannot be null!");
        com.emajliramokade.api.model.Guards.checkNulls(value);
        this.moderacijeKada = value;

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
