package com.emajliramokade.api.model.Resursi;

public final class Fingerprint implements java.io.Serializable {
    public Fingerprint(
            final byte[] sha1Bytes,
            final byte[] sha1Pixels) {
        setSha1Bytes(sha1Bytes);
        setSha1Pixels(sha1Pixels);
    }

    public Fingerprint() {
        this.sha1Bytes = new byte[0];
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 647822014;
        result = prime * result + (java.util.Arrays.hashCode(this.sha1Bytes));
        result = prime * result + (java.util.Arrays.hashCode(this.sha1Pixels));
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof Fingerprint)) return false;
        final Fingerprint other = (Fingerprint) obj;

        if (!(java.util.Arrays.equals(this.sha1Bytes, other.sha1Bytes)))
            return false;
        if (!(java.util.Arrays.equals(this.sha1Pixels, other.sha1Pixels)))
            return false;

        return true;
    }

    @Override
    public String toString() {
        return "Fingerprint(" + sha1Bytes + ',' + sha1Pixels + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private byte[] sha1Bytes;

    public byte[] getSha1Bytes() {
        return sha1Bytes;
    }

    public Fingerprint setSha1Bytes(final byte[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"sha1Bytes\" cannot be null!");
        this.sha1Bytes = value;

        return this;
    }

    private byte[] sha1Pixels;

    public byte[] getSha1Pixels() {
        return sha1Pixels;
    }

    public Fingerprint setSha1Pixels(final byte[] value) {
        this.sha1Pixels = value;

        return this;
    }
}
