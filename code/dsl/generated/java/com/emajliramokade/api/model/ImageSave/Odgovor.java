package com.emajliramokade.api.model.ImageSave;

public final class Odgovor implements java.io.Serializable {
    public Odgovor() {}

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

        return true;
    }

    @Override
    public String toString() {
        return "Odgovor(" + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

}
