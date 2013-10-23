package com.emajliramokade.api.model.ImageSave;

public final class Zahtjev implements java.io.Serializable {
    public Zahtjev(
            final byte[] thumbnail,
            final byte[] original,
            final byte[] email,
            final byte[] web) {
        setThumbnail(thumbnail);
        setOriginal(original);
        setEmail(email);
        setWeb(web);
    }

    public Zahtjev() {
        this.thumbnail = new byte[0];
        this.original = new byte[0];
        this.email = new byte[0];
        this.web = new byte[0];
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 1351063924;
        result = prime * result + (java.util.Arrays.hashCode(this.thumbnail));
        result = prime * result + (java.util.Arrays.hashCode(this.original));
        result = prime * result + (java.util.Arrays.hashCode(this.email));
        result = prime * result + (java.util.Arrays.hashCode(this.web));
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof Zahtjev)) return false;
        final Zahtjev other = (Zahtjev) obj;

        if (!(java.util.Arrays.equals(this.thumbnail, other.thumbnail)))
            return false;
        if (!(java.util.Arrays.equals(this.original, other.original)))
            return false;
        if (!(java.util.Arrays.equals(this.email, other.email))) return false;
        if (!(java.util.Arrays.equals(this.web, other.web))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "Zahtjev(" + thumbnail + ',' + original + ',' + email + ','
                + web + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private byte[] thumbnail;

    public byte[] getThumbnail() {
        return thumbnail;
    }

    public Zahtjev setThumbnail(final byte[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"thumbnail\" cannot be null!");
        this.thumbnail = value;

        return this;
    }

    private byte[] original;

    public byte[] getOriginal() {
        return original;
    }

    public Zahtjev setOriginal(final byte[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"original\" cannot be null!");
        this.original = value;

        return this;
    }

    private byte[] email;

    public byte[] getEmail() {
        return email;
    }

    public Zahtjev setEmail(final byte[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"email\" cannot be null!");
        this.email = value;

        return this;
    }

    private byte[] web;

    public byte[] getWeb() {
        return web;
    }

    public Zahtjev setWeb(final byte[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"web\" cannot be null!");
        this.web = value;

        return this;
    }
}
