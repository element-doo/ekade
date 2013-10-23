package com.emajliramokade.api.model.PopisKada;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;
import com.fasterxml.jackson.annotation.*;

public class Kada implements java.io.Serializable, AggregateRoot {
    public Kada() {
        _serviceLocator = Bootstrap.getLocator();
        _domainProxy = _serviceLocator.resolve(DomainProxy.class);
        _crudProxy = _serviceLocator.resolve(CrudProxy.class);
        this.ID = java.util.UUID.randomUUID();
        this.dodana = new org.joda.time.DateTime();
        this.brojacSlanja = 0;
        this.slikeKade = new com.emajliramokade.api.model.Resursi.SlikeKade[0];
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
        final Kada other = (Kada) obj;

        return URI != null && URI.equals(other.URI);
    }

    @Override
    public String toString() {
        return URI != null ? "Kada(" + URI + ')' : "new Kada("
                + super.hashCode() + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    public Kada(
            final java.util.UUID ID,
            final org.joda.time.DateTime odobrena,
            final org.joda.time.DateTime odbijena,
            final int brojacSlanja,
            final String komentar,
            final com.emajliramokade.api.model.Resursi.SlikeKade[] slikeKade) {
        _serviceLocator = Bootstrap.getLocator();
        _domainProxy = _serviceLocator.resolve(DomainProxy.class);
        _crudProxy = _serviceLocator.resolve(CrudProxy.class);
        setID(ID);
        setOdobrena(odobrena);
        setOdbijena(odbijena);
        setBrojacSlanja(brojacSlanja);
        setKomentar(komentar);
        setSlikeKade(slikeKade);
    }

    @JsonCreator
    private Kada(
            @JacksonInject("_serviceLocator") final ServiceLocator _serviceLocator,
            @JsonProperty("URI") final String URI,
            @JsonProperty("ID") final java.util.UUID ID,
            @JsonProperty("dodana") final org.joda.time.DateTime dodana,
            @JsonProperty("odobrena") final org.joda.time.DateTime odobrena,
            @JsonProperty("odbijena") final org.joda.time.DateTime odbijena,
            @JsonProperty("brojacSlanja") final int brojacSlanja,
            @JsonProperty("komentar") final String komentar,
            @JsonProperty("slikeKadeURI") final String[] slikeKadeURI) {
        this._serviceLocator = _serviceLocator;
        this._domainProxy = _serviceLocator.resolve(DomainProxy.class);
        this._crudProxy = _serviceLocator.resolve(CrudProxy.class);
        this.URI = URI;
        this.ID = ID == null ? java.util.UUID.randomUUID() : ID;
        this.dodana = dodana == null ? new org.joda.time.DateTime() : dodana;
        this.odobrena = odobrena;
        this.odbijena = odbijena;
        this.brojacSlanja = brojacSlanja;
        this.komentar = komentar;
        this.slikeKadeURI = slikeKadeURI == null ? new String[0] : slikeKadeURI;
    }

    public static Kada find(final String uri) throws java.io.IOException {
        return find(uri, Bootstrap.getLocator());
    }

    public static Kada find(final String uri, final ServiceLocator locator)
            throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(CrudProxy.class).read(Kada.class, uri).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<Kada> find(final Iterable<String> uris)
            throws java.io.IOException {
        return find(uris, Bootstrap.getLocator());
    }

    public static java.util.List<Kada> find(
            final Iterable<String> uris,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class).find(Kada.class, uris).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<Kada> findAll() throws java.io.IOException {
        return findAll(null, null, Bootstrap.getLocator());
    }

    public static java.util.List<Kada> findAll(final ServiceLocator locator)
            throws java.io.IOException {
        return findAll(null, null, locator);
    }

    public static java.util.List<Kada> findAll(
            final Integer limit,
            final Integer offset) throws java.io.IOException {
        return findAll(limit, offset, Bootstrap.getLocator());
    }

    public static java.util.List<Kada> findAll(
            final Integer limit,
            final Integer offset,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class)
                    .findAll(Kada.class, limit, offset, null).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<Kada> search(
            final Specification<Kada> specification) throws java.io.IOException {
        return search(specification, null, null, Bootstrap.getLocator());
    }

    public static java.util.List<Kada> search(
            final Specification<Kada> specification,
            final ServiceLocator locator) throws java.io.IOException {
        return search(specification, null, null, locator);
    }

    public static java.util.List<Kada> search(
            final Specification<Kada> specification,
            final Integer limit,
            final Integer offset) throws java.io.IOException {
        return search(specification, limit, offset, Bootstrap.getLocator());
    }

    public static java.util.List<Kada> search(
            final Specification<Kada> specification,
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
                    .resolve(DomainProxy.class).count(Kada.class).get()
                    .longValue();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static long count(final Specification<Kada> specification)
            throws java.io.IOException {
        return count(specification, Bootstrap.getLocator());
    }

    public static long count(
            final Specification<Kada> specification,
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
            final com.emajliramokade.api.model.PopisKada.Kada result) {
        this.URI = result.URI;

        this.ID = result.ID;
        this.dodana = result.dodana;
        this.odobrena = result.odobrena;
        this.odbijena = result.odbijena;
        this.brojacSlanja = result.brojacSlanja;
        this.komentar = result.komentar;
        this.slikeKade = result.slikeKade;
        this.slikeKadeURI = result.slikeKadeURI;
    }

    public Kada persist() throws java.io.IOException {
        final Kada result;
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

    public Kada delete() throws java.io.IOException {
        try {
            return _crudProxy.delete(Kada.class, URI).get();
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

    public Kada setID(final java.util.UUID value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"ID\" cannot be null!");
        this.ID = value;

        return this;
    }

    private org.joda.time.DateTime dodana;

    @JsonProperty("dodana")
    @JsonInclude(JsonInclude.Include.NON_EMPTY)
    public org.joda.time.DateTime getDodana() {
        return dodana;
    }

    private Kada setDodana(final org.joda.time.DateTime value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"dodana\" cannot be null!");
        this.dodana = value;

        return this;
    }

    private org.joda.time.DateTime odobrena;

    @JsonProperty("odobrena")
    public org.joda.time.DateTime getOdobrena() {
        return odobrena;
    }

    public Kada setOdobrena(final org.joda.time.DateTime value) {
        this.odobrena = value;

        return this;
    }

    private org.joda.time.DateTime odbijena;

    @JsonProperty("odbijena")
    public org.joda.time.DateTime getOdbijena() {
        return odbijena;
    }

    public Kada setOdbijena(final org.joda.time.DateTime value) {
        this.odbijena = value;

        return this;
    }

    private int brojacSlanja;

    @JsonProperty("brojacSlanja")
    @JsonInclude(JsonInclude.Include.NON_EMPTY)
    public int getBrojacSlanja() {
        return brojacSlanja;
    }

    public Kada setBrojacSlanja(final int value) {
        this.brojacSlanja = value;

        return this;
    }

    private String komentar;

    @JsonProperty("komentar")
    public String getKomentar() {
        return komentar;
    }

    public Kada setKomentar(final String value) {
        this.komentar = value;

        return this;
    }

    private String[] slikeKadeURI;

    @JsonProperty("slikeKadeURI")
    @JsonInclude(JsonInclude.Include.NON_EMPTY)
    public String[] getSlikeKadeURI() {
        return this.slikeKadeURI;
    }

    private com.emajliramokade.api.model.Resursi.SlikeKade[] slikeKade;

    @JsonIgnore
    public com.emajliramokade.api.model.Resursi.SlikeKade[] getSlikeKade()
            throws java.io.IOException {
        if (slikeKadeURI == null || slikeKadeURI.length == 0)
            return new com.emajliramokade.api.model.Resursi.SlikeKade[0];

        if (slikeKadeURI != null
                && (slikeKade == null || slikeKade.length != slikeKadeURI.length))
            try {
                slikeKade = _domainProxy
                        .find(com.emajliramokade.api.model.Resursi.SlikeKade.class,
                                slikeKadeURI)
                        .get()
                        .toArray(
                                new com.emajliramokade.api.model.Resursi.SlikeKade[slikeKadeURI.length]);
            } catch (final InterruptedException e) {
                throw new java.io.IOException(e);
            } catch (final java.util.concurrent.ExecutionException e) {
                throw new java.io.IOException(e);
            }
        return slikeKade;
    }

    public Kada setSlikeKade(
            final com.emajliramokade.api.model.Resursi.SlikeKade[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"slikeKade\" cannot be null!");
        com.emajliramokade.api.model.Guards.checkNulls(value);

        if (value != null) {
            for (final com.emajliramokade.api.model.Resursi.SlikeKade refEnt : value)
                if (refEnt == null || refEnt.getURI() == null)
                    throw new IllegalArgumentException(
                            "Reference \"Resursi.SlikeKade\" for property \"slikeKade\" must be persisted before it's assigned");
        }
        this.slikeKade = value;

        this.slikeKadeURI = new String[value.length];
        int i = 0;
        for (final com.emajliramokade.api.model.Resursi.SlikeKade it : value) {
            this.slikeKadeURI[i] = it.getURI();
            i++;
        }
        return this;
    }
}
