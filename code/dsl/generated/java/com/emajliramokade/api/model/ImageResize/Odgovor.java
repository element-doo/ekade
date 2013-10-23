package com.emajliramokade.api.model.ImageResize;

public final class Odgovor implements java.io.Serializable {
    public Odgovor(
            final java.util.List<com.emajliramokade.api.model.ImageResize.Slika> odgovori) {
        setOdgovori(odgovori);
    }

    public Odgovor() {
        this.odgovori = new java.util.ArrayList<com.emajliramokade.api.model.ImageResize.Slika>();
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 387031694;
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof Odgovor)) return false;
        final Odgovor other = (Odgovor) obj;

        if (!(this.odgovori.equals(other.odgovori))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "Odgovor(" + odgovori + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private java.util.List<com.emajliramokade.api.model.ImageResize.Slika> odgovori;

    public java.util.List<com.emajliramokade.api.model.ImageResize.Slika> getOdgovori() {
        return odgovori;
    }

    public Odgovor setOdgovori(
            final java.util.List<com.emajliramokade.api.model.ImageResize.Slika> value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"odgovori\" cannot be null!");
        com.emajliramokade.api.model.Guards.checkNulls(value);
        this.odgovori = value;

        return this;
    }
}
