package com.emajliramokade.api.model.Api;

public final class Zahtjev implements java.io.Serializable {
    public Zahtjev(
            final String email,
            final String kadaID) {
        setEmail(email);
        setKadaID(kadaID);
    }

    public Zahtjev() {
        this.email = "";
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 1351063924;
        result = prime * result
                + (this.email != null ? this.email.hashCode() : 0);
        result = prime * result
                + (this.kadaID != null ? this.kadaID.hashCode() : 0);
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof Zahtjev)) return false;
        final Zahtjev other = (Zahtjev) obj;

        if (!(this.email.equals(other.email))) return false;
        if (!(this.kadaID == other.kadaID || this.kadaID != null
                && this.kadaID.equals(other.kadaID))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "Zahtjev(" + email + ',' + kadaID + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private String email;

    public String getEmail() {
        return email;
    }

    public Zahtjev setEmail(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"email\" cannot be null!");
        this.email = value;

        return this;
    }

    private String kadaID;

    public String getKadaID() {
        return kadaID;
    }

    public Zahtjev setKadaID(final String value) {
        this.kadaID = value;

        return this;
    }
}
