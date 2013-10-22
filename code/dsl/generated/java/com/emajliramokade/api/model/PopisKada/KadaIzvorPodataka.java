package com.emajliramokade.api.model.PopisKada;

import com.dslplatform.patterns.*;
import com.dslplatform.client.*;
import com.fasterxml.jackson.annotation.*;

public final class KadaIzvorPodataka implements Identifiable,
        java.io.Serializable {
    @JsonCreator
    public KadaIzvorPodataka(
            @JsonProperty("URI") final String URI,
            @JsonProperty("odobrena") final org.joda.time.DateTime odobrena,
            @JsonProperty("odbijena") final org.joda.time.DateTime odbijena,
            @JsonProperty("brojacSlanja") final int brojacSlanja,
            @JsonProperty("dodana") final org.joda.time.DateTime dodana,
            @JsonProperty("slikeKade") final com.emajliramokade.api.model.Resursi.SlikeKade[] slikeKade) {
        this.URI = URI;
        this.odobrena = odobrena;
        this.odbijena = odbijena;
        this.brojacSlanja = brojacSlanja;
        this.dodana = dodana;
        if (dodana == null)
            throw new IllegalArgumentException(
                    "Property \"dodana\" cannot be null!");
        this.slikeKade = slikeKade;
        if (slikeKade == null)
            throw new IllegalArgumentException(
                    "Property \"slikeKade\" cannot be null!");
        com.emajliramokade.api.model.Guards.checkNulls(slikeKade);
    }

    private KadaIzvorPodataka() {
        this.URI = null;
        this.odobrena = null;
        this.odbijena = null;
        this.brojacSlanja = 0;
        this.dodana = null;
        this.slikeKade = null;
    }

    private final String URI;

    public String getURI() {
        return this.URI;
    }

    @Override
    public int hashCode() {
        return URI.hashCode();
    }

    @Override
    public boolean equals(Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (getClass() != obj.getClass()) return false;
        final KadaIzvorPodataka other = (KadaIzvorPodataka) obj;

        return URI.equals(other.URI);
    }

    @Override
    public String toString() {
        return "KadaIzvorPodataka(" + URI + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private final org.joda.time.DateTime odobrena;

    public org.joda.time.DateTime getOdobrena() {
        return this.odobrena;
    }

    private final org.joda.time.DateTime odbijena;

    public org.joda.time.DateTime getOdbijena() {
        return this.odbijena;
    }

    private final int brojacSlanja;

    public int getBrojacSlanja() {
        return this.brojacSlanja;
    }

    private final org.joda.time.DateTime dodana;

    public org.joda.time.DateTime getDodana() {
        return this.dodana;
    }

    private final com.emajliramokade.api.model.Resursi.SlikeKade[] slikeKade;

    public com.emajliramokade.api.model.Resursi.SlikeKade[] getSlikeKade() {
        return this.slikeKade;
    }

    public static class NemoderiraneKade implements java.io.Serializable,
            Specification<KadaIzvorPodataka> {
        public NemoderiraneKade() {}

        private static final long serialVersionUID = 0x0097000a;

        public java.util.List<KadaIzvorPodataka> search()
                throws java.io.IOException {
            return search(null, null, Bootstrap.getLocator());
        }

        public java.util.List<KadaIzvorPodataka> search(
                final ServiceLocator locator) throws java.io.IOException {
            return search(null, null, locator);
        }

        public java.util.List<KadaIzvorPodataka> search(
                final Integer limit,
                final Integer offset) throws java.io.IOException {
            return search(limit, offset, Bootstrap.getLocator());
        }

        public java.util.List<KadaIzvorPodataka> search(
                final Integer limit,
                final Integer offset,
                final ServiceLocator locator) throws java.io.IOException {
            try {
                return (locator != null ? locator : Bootstrap.getLocator())
                        .resolve(DomainProxy.class)
                        .search(this, limit, offset, null).get();
            } catch (final InterruptedException e) {
                throw new java.io.IOException(e);
            } catch (final java.util.concurrent.ExecutionException e) {
                throw new java.io.IOException(e);
            }
        }

        public long count() throws java.io.IOException {
            return count(Bootstrap.getLocator());
        }

        public long count(final ServiceLocator locator)
                throws java.io.IOException {
            try {
                return (locator != null ? locator : Bootstrap.getLocator())
                        .resolve(DomainProxy.class).count(this).get()
                        .longValue();
            } catch (final InterruptedException e) {
                throw new java.io.IOException(e);
            } catch (final java.util.concurrent.ExecutionException e) {
                throw new java.io.IOException(e);
            }
        }
    }

    public static class OdobreneKade implements java.io.Serializable,
            Specification<KadaIzvorPodataka> {
        public OdobreneKade() {}

        private static final long serialVersionUID = 0x0097000a;

        public java.util.List<KadaIzvorPodataka> search()
                throws java.io.IOException {
            return search(null, null, Bootstrap.getLocator());
        }

        public java.util.List<KadaIzvorPodataka> search(
                final ServiceLocator locator) throws java.io.IOException {
            return search(null, null, locator);
        }

        public java.util.List<KadaIzvorPodataka> search(
                final Integer limit,
                final Integer offset) throws java.io.IOException {
            return search(limit, offset, Bootstrap.getLocator());
        }

        public java.util.List<KadaIzvorPodataka> search(
                final Integer limit,
                final Integer offset,
                final ServiceLocator locator) throws java.io.IOException {
            try {
                return (locator != null ? locator : Bootstrap.getLocator())
                        .resolve(DomainProxy.class)
                        .search(this, limit, offset, null).get();
            } catch (final InterruptedException e) {
                throw new java.io.IOException(e);
            } catch (final java.util.concurrent.ExecutionException e) {
                throw new java.io.IOException(e);
            }
        }

        public long count() throws java.io.IOException {
            return count(Bootstrap.getLocator());
        }

        public long count(final ServiceLocator locator)
                throws java.io.IOException {
            try {
                return (locator != null ? locator : Bootstrap.getLocator())
                        .resolve(DomainProxy.class).count(this).get()
                        .longValue();
            } catch (final InterruptedException e) {
                throw new java.io.IOException(e);
            } catch (final java.util.concurrent.ExecutionException e) {
                throw new java.io.IOException(e);
            }
        }
    }

    public static KadaIzvorPodataka find(final String uri)
            throws java.io.IOException {
        return find(uri, null);
    }

    public static KadaIzvorPodataka find(
            final String uri,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(CrudProxy.class)
                    .read(KadaIzvorPodataka.class, uri).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<KadaIzvorPodataka> find(
            final Iterable<String> uris) throws java.io.IOException {
        return find(uris, Bootstrap.getLocator());
    }

    public static java.util.List<KadaIzvorPodataka> find(
            final Iterable<String> uris,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class)
                    .find(KadaIzvorPodataka.class, uris).get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<KadaIzvorPodataka> findAll()
            throws java.io.IOException {
        return findAll(null, null, Bootstrap.getLocator());
    }

    public static java.util.List<KadaIzvorPodataka> findAll(
            final ServiceLocator locator) throws java.io.IOException {
        return findAll(null, null, locator);
    }

    public static java.util.List<KadaIzvorPodataka> findAll(
            final Integer limit,
            final Integer offset) throws java.io.IOException {
        return findAll(limit, offset, Bootstrap.getLocator());
    }

    public static java.util.List<KadaIzvorPodataka> findAll(
            final Integer limit,
            final Integer offset,
            final ServiceLocator locator) throws java.io.IOException {
        try {
            return (locator != null ? locator : Bootstrap.getLocator())
                    .resolve(DomainProxy.class)
                    .findAll(KadaIzvorPodataka.class, limit, offset, null)
                    .get();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static java.util.List<KadaIzvorPodataka> search(
            final Specification<KadaIzvorPodataka> specification)
            throws java.io.IOException {
        return search(specification, null, null, Bootstrap.getLocator());
    }

    public static java.util.List<KadaIzvorPodataka> search(
            final Specification<KadaIzvorPodataka> specification,
            final ServiceLocator locator) throws java.io.IOException {
        return search(specification, null, null, locator);
    }

    public static java.util.List<KadaIzvorPodataka> search(
            final Specification<KadaIzvorPodataka> specification,
            final Integer limit,
            final Integer offset) throws java.io.IOException {
        return search(specification, limit, offset, Bootstrap.getLocator());
    }

    public static java.util.List<KadaIzvorPodataka> search(
            final Specification<KadaIzvorPodataka> specification,
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
                    .resolve(DomainProxy.class).count(KadaIzvorPodataka.class)
                    .get().longValue();
        } catch (final InterruptedException e) {
            throw new java.io.IOException(e);
        } catch (final java.util.concurrent.ExecutionException e) {
            throw new java.io.IOException(e);
        }
    }

    public static long count(
            final Specification<KadaIzvorPodataka> specification)
            throws java.io.IOException {
        return count(specification, Bootstrap.getLocator());
    }

    public static long count(
            final Specification<KadaIzvorPodataka> specification,
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
}
