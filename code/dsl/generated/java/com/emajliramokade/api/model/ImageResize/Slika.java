package com.emajliramokade.api.model.ImageResize;

public final class Slika implements java.io.Serializable {
    public Slika(
            final byte[] body) {
        setBody(body);
    }

    public Slika() {
        this.body = new byte[0];
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 192856024;
        result = prime * result + (java.util.Arrays.hashCode(this.body));
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof Slika)) return false;
        final Slika other = (Slika) obj;

        if (!(java.util.Arrays.equals(this.body, other.body))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "Slika(" + body + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private byte[] body;

    public byte[] getBody() {
        return body;
    }

    public Slika setBody(final byte[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"body\" cannot be null!");
        this.body = value;

        return this;
    }
}
