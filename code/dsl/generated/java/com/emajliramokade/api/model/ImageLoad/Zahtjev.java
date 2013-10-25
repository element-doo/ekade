package com.emajliramokade.api.model.ImageLoad;

public final class Zahtjev implements java.io.Serializable {
    public Zahtjev(
            final java.util.UUID kadaID,
            final String tipSlike) {
        setKadaID(kadaID);
        setTipSlike(tipSlike);
    }

    public Zahtjev() {
        this.kadaID = java.util.UUID.randomUUID();
        this.tipSlike = "";
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 1351063924;
        result = prime * result
                + (this.kadaID != null ? this.kadaID.hashCode() : 0);
        result = prime * result
                + (this.tipSlike != null ? this.tipSlike.hashCode() : 0);
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof Zahtjev)) return false;
        final Zahtjev other = (Zahtjev) obj;

        if (!(this.kadaID.equals(other.kadaID))) return false;
        if (!(this.tipSlike.equals(other.tipSlike))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "Zahtjev(" + kadaID + ',' + tipSlike + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private java.util.UUID kadaID;

    public java.util.UUID getKadaID() {
        return kadaID;
    }

    public Zahtjev setKadaID(final java.util.UUID value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"kadaID\" cannot be null!");
        this.kadaID = value;

        return this;
    }

    private String tipSlike;

    public String getTipSlike() {
        return tipSlike;
    }

    public Zahtjev setTipSlike(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"tipSlike\" cannot be null!");
        this.tipSlike = value;

        return this;
    }
}
