package com.emajliramokade.api.model.ImageLoad;

public final class Odgovor implements java.io.Serializable {
    public Odgovor(
            final com.emajliramokade.api.model.Resursi.PodaciSlike podaciSlike,
            final byte[] body) {
        setPodaciSlike(podaciSlike);
        setBody(body);
    }

    public Odgovor() {
        this.podaciSlike = new com.emajliramokade.api.model.Resursi.PodaciSlike();
        this.body = new byte[0];
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 387031694;
        result = prime * result + (this.podaciSlike.hashCode());
        result = prime * result + (java.util.Arrays.hashCode(this.body));
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof Odgovor)) return false;
        final Odgovor other = (Odgovor) obj;

        if (!(this.podaciSlike.equals(other.podaciSlike))) return false;
        if (!(java.util.Arrays.equals(this.body, other.body))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "Odgovor(" + podaciSlike + ',' + body + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private com.emajliramokade.api.model.Resursi.PodaciSlike podaciSlike;

    public com.emajliramokade.api.model.Resursi.PodaciSlike getPodaciSlike() {
        return podaciSlike;
    }

    public Odgovor setPodaciSlike(
            final com.emajliramokade.api.model.Resursi.PodaciSlike value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"podaciSlike\" cannot be null!");
        this.podaciSlike = value;

        return this;
    }

    private byte[] body;

    public byte[] getBody() {
        return body;
    }

    public Odgovor setBody(final byte[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"body\" cannot be null!");
        this.body = value;

        return this;
    }
}
