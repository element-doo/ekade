package com.emajliramokade.api.model.PopisKada;

public final class ModeriranaKada
        implements
        java.io.Serializable,
        com.emajliramokade.api.model.PopisKada.KadaEvent<com.emajliramokade.api.model.PopisKada.ModeriranaKada> {
    public ModeriranaKada(
            final boolean odobrena,
            final java.util.UUID kadaID) {
        setOdobrena(odobrena);
        setKadaID(kadaID);
    }

    public ModeriranaKada() {
        this.odobrena = false;
        this.kadaID = java.util.UUID.randomUUID();
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 565934485;
        result = prime * result + (this.odobrena ? 1231 : 1237);
        result = prime * result
                + (this.kadaID != null ? this.kadaID.hashCode() : 0);
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof ModeriranaKada)) return false;
        final ModeriranaKada other = (ModeriranaKada) obj;

        if (!(this.odobrena == other.odobrena)) return false;
        if (!(this.kadaID.equals(other.kadaID))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "ModeriranaKada(" + odobrena + ',' + kadaID + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private boolean odobrena;

    public boolean getOdobrena() {
        return odobrena;
    }

    public ModeriranaKada setOdobrena(final boolean value) {
        this.odobrena = value;

        return this;
    }

    private java.util.UUID kadaID;

    public java.util.UUID getKadaID() {
        return kadaID;
    }

    public ModeriranaKada setKadaID(final java.util.UUID value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"kadaID\" cannot be null!");
        this.kadaID = value;

        return this;
    }
}
