package com.emajliramokade.api.model.ImageResize;

public final class ResizeZahtjev implements java.io.Serializable {
    public ResizeZahtjev(
            final int width,
            final int height,
            final int depth,
            final String format) {
        setWidth(width);
        setHeight(height);
        setDepth(depth);
        setFormat(format);
    }

    public ResizeZahtjev() {
        this.width = 0;
        this.height = 0;
        this.depth = 0;
        this.format = "";
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 892679364;
        result = prime * result + (this.width);
        result = prime * result + (this.height);
        result = prime * result + (this.depth);
        result = prime * result
                + (this.format != null ? this.format.hashCode() : 0);
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof ResizeZahtjev)) return false;
        final ResizeZahtjev other = (ResizeZahtjev) obj;

        if (!(this.width == other.width)) return false;
        if (!(this.height == other.height)) return false;
        if (!(this.depth == other.depth)) return false;
        if (!(this.format.equals(other.format))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "ResizeZahtjev(" + width + ',' + height + ',' + depth + ','
                + format + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private int width;

    public int getWidth() {
        return width;
    }

    public ResizeZahtjev setWidth(final int value) {
        this.width = value;

        return this;
    }

    private int height;

    public int getHeight() {
        return height;
    }

    public ResizeZahtjev setHeight(final int value) {
        this.height = value;

        return this;
    }

    private int depth;

    public int getDepth() {
        return depth;
    }

    public ResizeZahtjev setDepth(final int value) {
        this.depth = value;

        return this;
    }

    private String format;

    public String getFormat() {
        return format;
    }

    public ResizeZahtjev setFormat(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"format\" cannot be null!");
        this.format = value;

        return this;
    }
}
