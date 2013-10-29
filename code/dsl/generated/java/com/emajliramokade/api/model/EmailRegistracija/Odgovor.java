package com.emajliramokade.api.model.EmailRegistracija;

public final class Odgovor implements java.io.Serializable {
    public Odgovor(
            final boolean odjavljen,
            final String unsubscribeID) {
        setOdjavljen(odjavljen);
        setUnsubscribeID(unsubscribeID);
    }

    public Odgovor() {
        this.odjavljen = false;
        this.unsubscribeID = "";
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 387031694;
        result = prime * result + (this.odjavljen ? 1231 : 1237);
        result = prime
                * result
                + (this.unsubscribeID != null
                        ? this.unsubscribeID.hashCode()
                        : 0);
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof Odgovor)) return false;
        final Odgovor other = (Odgovor) obj;

        if (!(this.odjavljen == other.odjavljen)) return false;
        if (!(this.unsubscribeID.equals(other.unsubscribeID))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "Odgovor(" + odjavljen + ',' + unsubscribeID + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private boolean odjavljen;

    public boolean getOdjavljen() {
        return odjavljen;
    }

    public Odgovor setOdjavljen(final boolean value) {
        this.odjavljen = value;

        return this;
    }

    private String unsubscribeID;

    public String getUnsubscribeID() {
        return unsubscribeID;
    }

    public Odgovor setUnsubscribeID(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"unsubscribeID\" cannot be null!");
        this.unsubscribeID = value;

        return this;
    }
}
