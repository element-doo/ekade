package com.emajliramokade.api.model.ImageProvjera;

public final class Zahtjev implements java.io.Serializable {
    public Zahtjev(
            final int velicinaSlike,
            final byte[] originalnaSlika) {
        setVelicinaSlike(velicinaSlike);
        setOriginalnaSlika(originalnaSlika);
    }

    public Zahtjev() {
        this.velicinaSlike = 0;
        this.originalnaSlika = new byte[0];
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 1351063924;
        result = prime * result + (this.velicinaSlike);
        result = prime * result
                + (java.util.Arrays.hashCode(this.originalnaSlika));
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof Zahtjev)) return false;
        final Zahtjev other = (Zahtjev) obj;

        if (!(this.velicinaSlike == other.velicinaSlike)) return false;
        if (!(java.util.Arrays.equals(this.originalnaSlika,
                other.originalnaSlika))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "Zahtjev(" + velicinaSlike + ',' + originalnaSlika + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private int velicinaSlike;

    public int getVelicinaSlike() {
        return velicinaSlike;
    }

    public Zahtjev setVelicinaSlike(final int value) {
        this.velicinaSlike = value;

        return this;
    }

    private byte[] originalnaSlika;

    public byte[] getOriginalnaSlika() {
        return originalnaSlika;
    }

    public Zahtjev setOriginalnaSlika(final byte[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"originalnaSlika\" cannot be null!");
        this.originalnaSlika = value;

        return this;
    }
}
