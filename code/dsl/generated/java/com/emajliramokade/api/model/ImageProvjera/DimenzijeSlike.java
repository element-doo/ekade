package com.emajliramokade.api.model.ImageProvjera;

public final class DimenzijeSlike implements java.io.Serializable {
    public DimenzijeSlike(
            final int width,
            final int height) {
        setWidth(width);
        setHeight(height);
    }

    public DimenzijeSlike() {
        this.width = 0;
        this.height = 0;
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 1592945895;
        result = prime * result + (this.width);
        result = prime * result + (this.height);
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof DimenzijeSlike)) return false;
        final DimenzijeSlike other = (DimenzijeSlike) obj;

        if (!(this.width == other.width)) return false;
        if (!(this.height == other.height)) return false;

        return true;
    }

    @Override
    public String toString() {
        return "DimenzijeSlike(" + width + ',' + height + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private int width;

    public int getWidth() {
        return width;
    }

    public DimenzijeSlike setWidth(final int value) {
        this.width = value;

        return this;
    }

    private int height;

    public int getHeight() {
        return height;
    }

    public DimenzijeSlike setHeight(final int value) {
        this.height = value;

        return this;
    }
}
