package com.emajliramokade.api.model.PopisKada;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;

public final class KadaDodana
        implements
        DomainEvent,
        java.io.Serializable,
        com.emajliramokade.api.model.PopisKada.KadaEvent<com.emajliramokade.api.model.PopisKada.KadaDodana>,
        com.emajliramokade.api.model.Resursi.SlikeUseCases<com.emajliramokade.api.model.PopisKada.KadaDodana> {
    public KadaDodana(
            final java.util.UUID kadaID,
            final com.emajliramokade.api.model.Resursi.PodaciSlike original,
            final com.emajliramokade.api.model.Resursi.PodaciSlike web,
            final com.emajliramokade.api.model.Resursi.PodaciSlike email,
            final com.emajliramokade.api.model.Resursi.PodaciSlike thumbnail) {
        setKadaID(kadaID);
        setOriginal(original);
        setWeb(web);
        setEmail(email);
        setThumbnail(thumbnail);
    }

    public KadaDodana() {
        this.kadaID = java.util.UUID.randomUUID();
        this.original = new com.emajliramokade.api.model.Resursi.PodaciSlike();
        this.web = new com.emajliramokade.api.model.Resursi.PodaciSlike();
        this.email = new com.emajliramokade.api.model.Resursi.PodaciSlike();
        this.thumbnail = new com.emajliramokade.api.model.Resursi.PodaciSlike();
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
        final KadaDodana other = (KadaDodana) obj;

        return URI != null && URI.equals(other.URI);
    }

    @Override
    public String toString() {
        return URI != null ? "KadaDodana(" + URI + ')' : "new KadaDodana("
                + super.hashCode() + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private java.util.UUID kadaID;

    public java.util.UUID getKadaID() {
        return kadaID;
    }

    public KadaDodana setKadaID(final java.util.UUID value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"kadaID\" cannot be null!");
        this.kadaID = value;

        return this;
    }

    private com.emajliramokade.api.model.Resursi.PodaciSlike original;

    public com.emajliramokade.api.model.Resursi.PodaciSlike getOriginal() {
        return original;
    }

    public KadaDodana setOriginal(
            final com.emajliramokade.api.model.Resursi.PodaciSlike value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"original\" cannot be null!");
        this.original = value;

        return this;
    }

    private com.emajliramokade.api.model.Resursi.PodaciSlike web;

    public com.emajliramokade.api.model.Resursi.PodaciSlike getWeb() {
        return web;
    }

    public KadaDodana setWeb(
            final com.emajliramokade.api.model.Resursi.PodaciSlike value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"web\" cannot be null!");
        this.web = value;

        return this;
    }

    private com.emajliramokade.api.model.Resursi.PodaciSlike email;

    public com.emajliramokade.api.model.Resursi.PodaciSlike getEmail() {
        return email;
    }

    public KadaDodana setEmail(
            final com.emajliramokade.api.model.Resursi.PodaciSlike value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"email\" cannot be null!");
        this.email = value;

        return this;
    }

    private com.emajliramokade.api.model.Resursi.PodaciSlike thumbnail;

    public com.emajliramokade.api.model.Resursi.PodaciSlike getThumbnail() {
        return thumbnail;
    }

    public KadaDodana setThumbnail(
            final com.emajliramokade.api.model.Resursi.PodaciSlike value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"thumbnail\" cannot be null!");
        this.thumbnail = value;

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
