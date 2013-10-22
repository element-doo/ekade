package com.emajliramokade.api.model.Resursi;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;
import com.fasterxml.jackson.annotation.*;

public class SlikeKade implements java.io.Serializable, AggregateRoot {
    public SlikeKade() {
        _serviceLocator = Bootstrap.getLocator();
        _domainProxy = _serviceLocator.resolve(DomainProxy.class);
        _crudProxy = _serviceLocator.resolve(CrudProxy.class);
        this.ID = java.util.UUID.randomUUID();
        this.original = new com.emajliramokade.api.model.Resursi.PodaciSlike();
        this.web = new com.emajliramokade.api.model.Resursi.PodaciSlike();
        this.email = new com.emajliramokade.api.model.Resursi.PodaciSlike();
        this.thumbnail = new com.emajliramokade.api.model.Resursi.PodaciSlike();
    }

    private transient final ServiceLocator _serviceLocator;
    private transient final DomainProxy _domainProxy;
    private transient final CrudProxy _crudProxy;

    private String URI;

    @JsonProperty("URI")
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
        final SlikeKade other = (SlikeKade) obj;

        return URI != null && URI.equals(other.URI);
    }

    @Override
    public String toString() {
        return URI != null ? "SlikeKade(" + URI + ')' : "new SlikeKade("
                + super.hashCode() + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    public SlikeKade(
            final com.emajliramokade.api.model.PopisKada.Kada kada,
            final com.emajliramokade.api.model.Resursi.PodaciSlike original,
            final com.emajliramokade.api.model.Resursi.PodaciSlike web,
            final com.emajliramokade.api.model.Resursi.PodaciSlike email,
            final com.emajliramokade.api.model.Resursi.PodaciSlike thumbnail) {
        _serviceLocator = Bootstrap.getLocator();
        _domainProxy = _serviceLocator.resolve(DomainProxy.class);
        _crudProxy = _serviceLocator.resolve(CrudProxy.class);
        setKada(kada);
        setOriginal(original);
        setWeb(web);
        setEmail(email);
        setThumbnail(thumbnail);
    }

    @JsonCreator
    private SlikeKade(
            @JacksonInject("_serviceLocator") final ServiceLocator _serviceLocator,
            @JsonProperty("URI") final String URI,
            @JsonProperty("ID") final java.util.UUID ID,
            @JsonProperty("kadaURI") final String kadaURI,
            @JsonProperty("original") final com.emajliramokade.api.model.Resursi.PodaciSlike original,
            @JsonProperty("web") final com.emajliramokade.api.model.Resursi.PodaciSlike web,
            @JsonProperty("email") final com.emajliramokade.api.model.Resursi.PodaciSlike email,
            @JsonProperty("thumbnail") final com.emajliramokade.api.model.Resursi.PodaciSlike thumbnail) {
        this._serviceLocator = _serviceLocator;
        this._domainProxy = _serviceLocator.resolve(DomainProxy.class);
        this._crudProxy = _serviceLocator.resolve(CrudProxy.class);
        this.URI = URI;
        this.ID = ID == null ? java.util.UUID.randomUUID() : ID;
        this.kadaURI = kadaURI == null ? null : kadaURI;
        this.original = original == null
                ? new com.emajliramokade.api.model.Resursi.PodaciSlike()
                : original;
        this.web = web == null
                ? new com.emajliramokade.api.model.Resursi.PodaciSlike()
                : web;
        this.email = email == null
                ? new com.emajliramokade.api.model.Resursi.PodaciSlike()
                : email;
        this.thumbnail = thumbnail == null
                ? new com.emajliramokade.api.model.Resursi.PodaciSlike()
                : thumbnail;
    }

    public static SlikeKade find(final String uri) throws java.io.IOException {
        return find(uri, Bootstrap.getLocator());
    }

    public static SlikeKade find(final String uri, final ServiceLocator locator)
            throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(CrudProxy.class).read(SlikeKade.class, uri).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<SlikeKade> find(final Iterable<String> uris)
            throws java.io.IOException {
        return find(uris, Bootstrap.getLocator());
    }

    public static java.util.List<SlikeKade> find(
            final Iterable<String> uris,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class).find(SlikeKade.class, uris)
                    .get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<SlikeKade> findAll()
            throws java.io.IOException {
        return findAll(null, null, Bootstrap.getLocator());
    }

    public static java.util.List<SlikeKade> findAll(final ServiceLocator locator)
            throws java.io.IOException {
        return findAll(null, null, locator);
    }

    public static java.util.List<SlikeKade> findAll(
            final Integer limit,
            final Integer offset) throws java.io.IOException {
        return findAll(limit, offset, Bootstrap.getLocator());
    }

    public static java.util.List<SlikeKade> findAll(
            final Integer limit,
            final Integer offset,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class)
                    .findAll(SlikeKade.class, limit, offset, null).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<SlikeKade> search(
            final Specification<SlikeKade> specification)
            throws java.io.IOException {
        return search(specification, null, null, Bootstrap.getLocator());
    }

    public static java.util.List<SlikeKade> search(
            final Specification<SlikeKade> specification,
            final ServiceLocator locator) throws java.io.IOException {
        return search(specification, null, null, locator);
    }

    public static java.util.List<SlikeKade> search(
            final Specification<SlikeKade> specification,
            final Integer limit,
            final Integer offset) throws java.io.IOException {
        return search(specification, limit, offset, Bootstrap.getLocator());
    }

    public static java.util.List<SlikeKade> search(
            final Specification<SlikeKade> specification,
            final Integer limit,
            final Integer offset,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class)
                    .search(specification, limit, offset, null).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static long count() throws java.io.IOException {
        return count(Bootstrap.getLocator());
    }

    public static long count(final ServiceLocator locator)
            throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class).count(SlikeKade.class).get()
                    .longValue();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static long count(final Specification<SlikeKade> specification)
            throws java.io.IOException {
        return count(specification, Bootstrap.getLocator());
    }

    public static long count(
            final Specification<SlikeKade> specification,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class).count(specification).get()
                    .longValue();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    private void updateWithAnother(
            final com.emajliramokade.api.model.Resursi.SlikeKade result) {
        this.URI = result.URI;

        this.ID = result.ID;
        this.kada = result.kada;
        this.kadaURI = result.kadaURI;
        this.original = result.original;
        this.web = result.web;
        this.email = result.email;
        this.thumbnail = result.thumbnail;
    }

    public SlikeKade persist() throws java.io.IOException {
        if (this.getKadaURI() == null) {
            throw new IllegalArgumentException(
                    "Cannot persist instance of 'com.emajliramokade.api.model.Resursi.SlikeKade' because reference 'kada' was not assigned");
        }
        final SlikeKade result;
        try {
            result = this.URI == null
                    ? _crudProxy.create(this).get()
                    : _crudProxy.update(this).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
        this.updateWithAnother(result);
        return this;
    }

    public SlikeKade delete() throws java.io.IOException {
        try {
            return _crudProxy.delete(SlikeKade.class, URI).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    private java.util.UUID ID;

    @JsonProperty("ID")
    @JsonInclude(JsonInclude.Include.NON_EMPTY)
    public java.util.UUID getID() {
        return ID;
    }

    private SlikeKade setID(final java.util.UUID value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"ID\" cannot be null!");
        this.ID = value;

        return this;
    }

    private String kadaURI;

    @JsonProperty("kadaURI")
    public String getKadaURI() {
        return this.kadaURI;
    }

    private com.emajliramokade.api.model.PopisKada.Kada kada;

    @JsonIgnore
    public com.emajliramokade.api.model.PopisKada.Kada getKada()
            throws java.io.IOException {
        if (kada != null && !kada.getURI().equals(kadaURI) || kada == null
                && kadaURI != null)
            try {
                kada = _crudProxy.read(
                        com.emajliramokade.api.model.PopisKada.Kada.class,
                        kadaURI).get();
            } catch (final InterruptedException e) {
                throw new java.io.IOException(e);
            } catch (final java.util.concurrent.ExecutionException e) {
                throw new java.io.IOException(e);
            }
        return kada;
    }

    public SlikeKade setKada(
            final com.emajliramokade.api.model.PopisKada.Kada value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"kada\" cannot be null!");

        if (value != null && value.getURI() == null)
            throw new IllegalArgumentException(
                    "Reference \"PopisKada.Kada\" for property \"kada\" must be persisted before it's assigned");
        this.kada = value;

        this.kadaURI = value.getURI();

        this.ID = value.getID();
        return this;
    }

    private com.emajliramokade.api.model.Resursi.PodaciSlike original;

    @JsonProperty("original")
    public com.emajliramokade.api.model.Resursi.PodaciSlike getOriginal() {
        return original;
    }

    public SlikeKade setOriginal(
            final com.emajliramokade.api.model.Resursi.PodaciSlike value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"original\" cannot be null!");
        this.original = value;

        return this;
    }

    private com.emajliramokade.api.model.Resursi.PodaciSlike web;

    @JsonProperty("web")
    public com.emajliramokade.api.model.Resursi.PodaciSlike getWeb() {
        return web;
    }

    public SlikeKade setWeb(
            final com.emajliramokade.api.model.Resursi.PodaciSlike value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"web\" cannot be null!");
        this.web = value;

        return this;
    }

    private com.emajliramokade.api.model.Resursi.PodaciSlike email;

    @JsonProperty("email")
    public com.emajliramokade.api.model.Resursi.PodaciSlike getEmail() {
        return email;
    }

    public SlikeKade setEmail(
            final com.emajliramokade.api.model.Resursi.PodaciSlike value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"email\" cannot be null!");
        this.email = value;

        return this;
    }

    private com.emajliramokade.api.model.Resursi.PodaciSlike thumbnail;

    @JsonProperty("thumbnail")
    public com.emajliramokade.api.model.Resursi.PodaciSlike getThumbnail() {
        return thumbnail;
    }

    public SlikeKade setThumbnail(
            final com.emajliramokade.api.model.Resursi.PodaciSlike value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"thumbnail\" cannot be null!");
        this.thumbnail = value;

        return this;
    }
}
