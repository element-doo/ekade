package com.emajliramokade.api.model.ImageResize;

public final class Zahtjev implements java.io.Serializable {
    public Zahtjev(
            final com.emajliramokade.api.model.ImageResize.Slika slika,
            final java.util.List<com.emajliramokade.api.model.ImageResize.ResizeZahtjev> zahtjevi) {
        setSlika(slika);
        setZahtjevi(zahtjevi);
    }

    public Zahtjev() {
        this.slika = new com.emajliramokade.api.model.ImageResize.Slika();
        this.zahtjevi = new java.util.ArrayList<com.emajliramokade.api.model.ImageResize.ResizeZahtjev>();
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 1351063924;
        result = prime * result + (this.slika.hashCode());
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof Zahtjev)) return false;
        final Zahtjev other = (Zahtjev) obj;

        if (!(this.slika.equals(other.slika))) return false;
        if (!(this.zahtjevi.equals(other.zahtjevi))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "Zahtjev(" + slika + ',' + zahtjevi + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private com.emajliramokade.api.model.ImageResize.Slika slika;

    public com.emajliramokade.api.model.ImageResize.Slika getSlika() {
        return slika;
    }

    public Zahtjev setSlika(
            final com.emajliramokade.api.model.ImageResize.Slika value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"slika\" cannot be null!");
        this.slika = value;

        return this;
    }

    private java.util.List<com.emajliramokade.api.model.ImageResize.ResizeZahtjev> zahtjevi;

    public java.util.List<com.emajliramokade.api.model.ImageResize.ResizeZahtjev> getZahtjevi() {
        return zahtjevi;
    }

    public Zahtjev setZahtjevi(
            final java.util.List<com.emajliramokade.api.model.ImageResize.ResizeZahtjev> value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"zahtjevi\" cannot be null!");
        com.emajliramokade.api.model.Guards.checkNulls(value);
        this.zahtjevi = value;

        return this;
    }
}
