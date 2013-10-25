package com.emajliramokade.api.model.Sigurnost;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;
import com.fasterxml.jackson.annotation.*;

public class Korisnik implements java.io.Serializable, AggregateRoot {
    public Korisnik() {
        _serviceLocator = Bootstrap.getLocator();
        _domainProxy = _serviceLocator.resolve(DomainProxy.class);
        _crudProxy = _serviceLocator.resolve(CrudProxy.class);
        this.username = "";
        this.salt = "";
        this.hashSifra = new byte[0];
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
        final Korisnik other = (Korisnik) obj;

        return URI != null && URI.equals(other.URI);
    }

    @Override
    public String toString() {
        return URI != null ? "Korisnik(" + URI + ')' : "new Korisnik("
                + super.hashCode() + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    public Korisnik(
            final String username,
            final String salt,
            final byte[] hashSifra) {
        _serviceLocator = Bootstrap.getLocator();
        _domainProxy = _serviceLocator.resolve(DomainProxy.class);
        _crudProxy = _serviceLocator.resolve(CrudProxy.class);
        setUsername(username);
        setSalt(salt);
        setHashSifra(hashSifra);
    }

    @JsonCreator
    private Korisnik(
            @JacksonInject("_serviceLocator") final ServiceLocator _serviceLocator,
            @JsonProperty("URI") final String URI,
            @JsonProperty("username") final String username,
            @JsonProperty("salt") final String salt,
            @JsonProperty("hashSifra") final byte[] hashSifra) {
        this._serviceLocator = _serviceLocator;
        this._domainProxy = _serviceLocator.resolve(DomainProxy.class);
        this._crudProxy = _serviceLocator.resolve(CrudProxy.class);
        this.URI = URI;
        this.username = username == null ? "" : username;
        this.salt = salt == null ? "" : salt;
        this.hashSifra = hashSifra == null ? new byte[0] : hashSifra;
    }

    public static Korisnik find(final String uri) throws java.io.IOException {
        return find(uri, Bootstrap.getLocator());
    }

    public static Korisnik find(final String uri, final ServiceLocator locator)
            throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(CrudProxy.class).read(Korisnik.class, uri).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<Korisnik> find(final Iterable<String> uris)
            throws java.io.IOException {
        return find(uris, Bootstrap.getLocator());
    }

    public static java.util.List<Korisnik> find(
            final Iterable<String> uris,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class).find(Korisnik.class, uris)
                    .get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<Korisnik> findAll() throws java.io.IOException {
        return findAll(null, null, Bootstrap.getLocator());
    }

    public static java.util.List<Korisnik> findAll(final ServiceLocator locator)
            throws java.io.IOException {
        return findAll(null, null, locator);
    }

    public static java.util.List<Korisnik> findAll(
            final Integer limit,
            final Integer offset) throws java.io.IOException {
        return findAll(limit, offset, Bootstrap.getLocator());
    }

    public static java.util.List<Korisnik> findAll(
            final Integer limit,
            final Integer offset,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class)
                    .findAll(Korisnik.class, limit, offset, null).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<Korisnik> search(
            final Specification<Korisnik> specification)
            throws java.io.IOException {
        return search(specification, null, null, Bootstrap.getLocator());
    }

    public static java.util.List<Korisnik> search(
            final Specification<Korisnik> specification,
            final ServiceLocator locator) throws java.io.IOException {
        return search(specification, null, null, locator);
    }

    public static java.util.List<Korisnik> search(
            final Specification<Korisnik> specification,
            final Integer limit,
            final Integer offset) throws java.io.IOException {
        return search(specification, limit, offset, Bootstrap.getLocator());
    }

    public static java.util.List<Korisnik> search(
            final Specification<Korisnik> specification,
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
                    .resolve(DomainProxy.class).count(Korisnik.class).get()
                    .longValue();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static long count(final Specification<Korisnik> specification)
            throws java.io.IOException {
        return count(specification, Bootstrap.getLocator());
    }

    public static long count(
            final Specification<Korisnik> specification,
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
            final com.emajliramokade.api.model.Sigurnost.Korisnik result) {
        this.URI = result.URI;

        this.username = result.username;
        this.salt = result.salt;
        this.hashSifra = result.hashSifra;
    }

    public Korisnik persist() throws java.io.IOException {
        final Korisnik result;
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

    public Korisnik delete() throws java.io.IOException {
        try {
            return _crudProxy.delete(Korisnik.class, URI).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    private String username;

    @JsonProperty("username")
    @JsonInclude(JsonInclude.Include.NON_EMPTY)
    public String getUsername() {
        return username;
    }

    public Korisnik setUsername(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"username\" cannot be null!");
        this.username = value;

        return this;
    }

    private String salt;

    @JsonProperty("salt")
    @JsonInclude(JsonInclude.Include.NON_EMPTY)
    public String getSalt() {
        return salt;
    }

    public Korisnik setSalt(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"salt\" cannot be null!");
        this.salt = value;

        return this;
    }

    private byte[] hashSifra;

    @JsonProperty("hashSifra")
    @JsonInclude(JsonInclude.Include.NON_EMPTY)
    public byte[] getHashSifra() {
        return hashSifra;
    }

    public Korisnik setHashSifra(final byte[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"hashSifra\" cannot be null!");
        this.hashSifra = value;

        return this;
    }
}
