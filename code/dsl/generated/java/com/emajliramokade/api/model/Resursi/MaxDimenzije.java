package com.emajliramokade.api.model.Resursi;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;
import com.fasterxml.jackson.annotation.*;

public class MaxDimenzije implements java.io.Serializable, AggregateRoot {
    public MaxDimenzije() {
        _serviceLocator = Bootstrap.getLocator();
        _domainProxy = _serviceLocator.resolve(DomainProxy.class);
        _crudProxy = _serviceLocator.resolve(CrudProxy.class);
        this.ID = "";
        this.width = 0;
        this.height = 0;
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
        final MaxDimenzije other = (MaxDimenzije) obj;

        return URI != null && URI.equals(other.URI);
    }

    @Override
    public String toString() {
        return URI != null ? "MaxDimenzije(" + URI + ')' : "new MaxDimenzije("
                + super.hashCode() + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    public MaxDimenzije(
            final String ID,
            final int width,
            final int height) {
        _serviceLocator = Bootstrap.getLocator();
        _domainProxy = _serviceLocator.resolve(DomainProxy.class);
        _crudProxy = _serviceLocator.resolve(CrudProxy.class);
        setID(ID);
        setWidth(width);
        setHeight(height);
    }

    @JsonCreator
    private MaxDimenzije(
            @JacksonInject("_serviceLocator") final ServiceLocator _serviceLocator,
            @JsonProperty("URI") final String URI,
            @JsonProperty("ID") final String ID,
            @JsonProperty("width") final int width,
            @JsonProperty("height") final int height) {
        this._serviceLocator = _serviceLocator;
        this._domainProxy = _serviceLocator.resolve(DomainProxy.class);
        this._crudProxy = _serviceLocator.resolve(CrudProxy.class);
        this.URI = URI;
        this.ID = ID == null ? "" : ID;
        this.width = width;
        this.height = height;
    }

    public static MaxDimenzije find(final String uri)
            throws java.io.IOException {
        return find(uri, Bootstrap.getLocator());
    }

    public static MaxDimenzije find(
            final String uri,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(CrudProxy.class).read(MaxDimenzije.class, uri)
                    .get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<MaxDimenzije> find(final Iterable<String> uris)
            throws java.io.IOException {
        return find(uris, Bootstrap.getLocator());
    }

    public static java.util.List<MaxDimenzije> find(
            final Iterable<String> uris,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class).find(MaxDimenzije.class, uris)
                    .get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<MaxDimenzije> findAll()
            throws java.io.IOException {
        return findAll(null, null, Bootstrap.getLocator());
    }

    public static java.util.List<MaxDimenzije> findAll(
            final ServiceLocator locator) throws java.io.IOException {
        return findAll(null, null, locator);
    }

    public static java.util.List<MaxDimenzije> findAll(
            final Integer limit,
            final Integer offset) throws java.io.IOException {
        return findAll(limit, offset, Bootstrap.getLocator());
    }

    public static java.util.List<MaxDimenzije> findAll(
            final Integer limit,
            final Integer offset,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class)
                    .findAll(MaxDimenzije.class, limit, offset, null).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<MaxDimenzije> search(
            final Specification<MaxDimenzije> specification)
            throws java.io.IOException {
        return search(specification, null, null, Bootstrap.getLocator());
    }

    public static java.util.List<MaxDimenzije> search(
            final Specification<MaxDimenzije> specification,
            final ServiceLocator locator) throws java.io.IOException {
        return search(specification, null, null, locator);
    }

    public static java.util.List<MaxDimenzije> search(
            final Specification<MaxDimenzije> specification,
            final Integer limit,
            final Integer offset) throws java.io.IOException {
        return search(specification, limit, offset, Bootstrap.getLocator());
    }

    public static java.util.List<MaxDimenzije> search(
            final Specification<MaxDimenzije> specification,
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
                    .resolve(DomainProxy.class).count(MaxDimenzije.class).get()
                    .longValue();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static long count(final Specification<MaxDimenzije> specification)
            throws java.io.IOException {
        return count(specification, Bootstrap.getLocator());
    }

    public static long count(
            final Specification<MaxDimenzije> specification,
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
            final com.emajliramokade.api.model.Resursi.MaxDimenzije result) {
        this.URI = result.URI;

        this.ID = result.ID;
        this.width = result.width;
        this.height = result.height;
    }

    public MaxDimenzije persist() throws java.io.IOException {
        final MaxDimenzije result;
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

    public MaxDimenzije delete() throws java.io.IOException {
        try {
            return _crudProxy.delete(MaxDimenzije.class, URI).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    private String ID;

    @JsonProperty("ID")
    @JsonInclude(JsonInclude.Include.NON_EMPTY)
    public String getID() {
        return ID;
    }

    public MaxDimenzije setID(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"ID\" cannot be null!");
        this.ID = value;

        return this;
    }

    private int width;

    @JsonProperty("width")
    @JsonInclude(JsonInclude.Include.NON_EMPTY)
    public int getWidth() {
        return width;
    }

    public MaxDimenzije setWidth(final int value) {
        this.width = value;

        return this;
    }

    private int height;

    @JsonProperty("height")
    @JsonInclude(JsonInclude.Include.NON_EMPTY)
    public int getHeight() {
        return height;
    }

    public MaxDimenzije setHeight(final int value) {
        this.height = value;

        return this;
    }

    private static MaxDimenzije StaticInstanceoriginal;

    public static MaxDimenzije original() throws java.io.IOException {
        if (StaticInstanceoriginal == null) {
            try {
                StaticInstanceoriginal = Bootstrap
                        .getLocator()
                        .resolve(CrudProxy.class)
                        .read(com.emajliramokade.api.model.Resursi.MaxDimenzije.class,
                                "Original").get();
            } catch (final InterruptedException e) {
                throw new java.io.IOException(e);
            } catch (final java.util.concurrent.ExecutionException e) {
                throw new java.io.IOException(e);
            }
        }
        return StaticInstanceoriginal;
    }

    private static MaxDimenzije StaticInstanceweb;

    public static MaxDimenzije web() throws java.io.IOException {
        if (StaticInstanceweb == null) {
            try {
                StaticInstanceweb = Bootstrap
                        .getLocator()
                        .resolve(CrudProxy.class)
                        .read(com.emajliramokade.api.model.Resursi.MaxDimenzije.class,
                                "Web").get();
            } catch (final InterruptedException e) {
                throw new java.io.IOException(e);
            } catch (final java.util.concurrent.ExecutionException e) {
                throw new java.io.IOException(e);
            }
        }
        return StaticInstanceweb;
    }

    private static MaxDimenzije StaticInstanceemail;

    public static MaxDimenzije email() throws java.io.IOException {
        if (StaticInstanceemail == null) {
            try {
                StaticInstanceemail = Bootstrap
                        .getLocator()
                        .resolve(CrudProxy.class)
                        .read(com.emajliramokade.api.model.Resursi.MaxDimenzije.class,
                                "Email").get();
            } catch (final InterruptedException e) {
                throw new java.io.IOException(e);
            } catch (final java.util.concurrent.ExecutionException e) {
                throw new java.io.IOException(e);
            }
        }
        return StaticInstanceemail;
    }

    private static MaxDimenzije StaticInstancethumbnail;

    public static MaxDimenzije thumbnail() throws java.io.IOException {
        if (StaticInstancethumbnail == null) {
            try {
                StaticInstancethumbnail = Bootstrap
                        .getLocator()
                        .resolve(CrudProxy.class)
                        .read(com.emajliramokade.api.model.Resursi.MaxDimenzije.class,
                                "Thumbnail").get();
            } catch (final InterruptedException e) {
                throw new java.io.IOException(e);
            } catch (final java.util.concurrent.ExecutionException e) {
                throw new java.io.IOException(e);
            }
        }
        return StaticInstancethumbnail;
    }
}
