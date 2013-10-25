package com.emajliramokade.api.model.Sigurnost;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;

public final class Registracija implements DomainEvent, java.io.Serializable {
    public Registracija(
            final String username,
            final String sifra) {
        setUsername(username);
        setSifra(sifra);
    }

    public Registracija() {
        this.username = "";
        this.sifra = "";
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
        final Registracija other = (Registracija) obj;

        return URI != null && URI.equals(other.URI);
    }

    @Override
    public String toString() {
        return URI != null ? "Registracija(" + URI + ')' : "new Registracija("
                + super.hashCode() + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private String username;

    public String getUsername() {
        return username;
    }

    public Registracija setUsername(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"username\" cannot be null!");
        this.username = value;

        return this;
    }

    private String sifra;

    public String getSifra() {
        return sifra;
    }

    public Registracija setSifra(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"sifra\" cannot be null!");
        this.sifra = value;

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
