package com.emajliramokade.api.model.EmailRegistracija;

public final class Zahtjev implements java.io.Serializable {
    public Zahtjev(
            final String email) {
        setEmail(email);
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
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof Zahtjev)) return false;
        final Zahtjev other = (Zahtjev) obj;

        if (!(this.email.equals(other.email))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "Zahtjev(" + email + ')';
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
}
