package com.emajliramokade.api.model.EmailProvjera;

public final class Odgovor implements java.io.Serializable {
    public Odgovor(
            final boolean status,
            final String poruka) {
        setStatus(status);
        setPoruka(poruka);
    }

    public Odgovor() {
        this.status = false;
        this.poruka = "";
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 387031694;
        result = prime * result + (this.status ? 1231 : 1237);
        result = prime * result
                + (this.poruka != null ? this.poruka.hashCode() : 0);
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof Odgovor)) return false;
        final Odgovor other = (Odgovor) obj;

        if (!(this.status == other.status)) return false;
        if (!(this.poruka.equals(other.poruka))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "Odgovor(" + status + ',' + poruka + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private boolean status;

    public boolean getStatus() {
        return status;
    }

    public Odgovor setStatus(final boolean value) {
        this.status = value;

        return this;
    }

    private String poruka;

    public String getPoruka() {
        return poruka;
    }

    public Odgovor setPoruka(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"poruka\" cannot be null!");
        this.poruka = value;

        return this;
    }
}
