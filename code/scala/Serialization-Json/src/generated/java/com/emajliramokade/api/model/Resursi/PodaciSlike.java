package com.emajliramokade.api.model.Resursi;

public final class PodaciSlike implements java.io.Serializable {
    public PodaciSlike(
            final String ime,
            final String format,
            final int width,
            final int height,
            final int size,
            final String filename) {
        setIme(ime);
        setFormat(format);
        setWidth(width);
        setHeight(height);
        setSize(size);
        this.filename = filename;
    }

    public PodaciSlike() {
        this.ime = "";
        this.format = "";
        this.width = 0;
        this.height = 0;
        this.size = 0;
        this.filename = "";
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 1215661402;
        result = prime * result + (this.ime != null ? this.ime.hashCode() : 0);
        result = prime * result
                + (this.format != null ? this.format.hashCode() : 0);
        result = prime * result + (this.width);
        result = prime * result + (this.height);
        result = prime * result + (this.size);
        result = prime * result
                + (this.filename != null ? this.filename.hashCode() : 0);
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof PodaciSlike)) return false;
        final PodaciSlike other = (PodaciSlike) obj;

        if (!(this.ime.equals(other.ime))) return false;
        if (!(this.format.equals(other.format))) return false;
        if (!(this.width == other.width)) return false;
        if (!(this.height == other.height)) return false;
        if (!(this.size == other.size)) return false;
        if (!(this.filename.equals(other.filename))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "PodaciSlike(" + ime + ',' + format + ',' + width + ',' + height
                + ',' + size + ',' + filename + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private String ime;

    public String getIme() {
        return ime;
    }

    public PodaciSlike setIme(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"ime\" cannot be null!");
        this.ime = value;

        return this;
    }

    private String format;

    public String getFormat() {
        return format;
    }

    public PodaciSlike setFormat(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"format\" cannot be null!");
        this.format = value;

        return this;
    }

    private int width;

    public int getWidth() {
        return width;
    }

    public PodaciSlike setWidth(final int value) {
        this.width = value;

        return this;
    }

    private int height;

    public int getHeight() {
        return height;
    }

    public PodaciSlike setHeight(final int value) {
        this.height = value;

        return this;
    }

    private int size;

    public int getSize() {
        return size;
    }

    public PodaciSlike setSize(final int value) {
        this.size = value;

        return this;
    }

    private final String filename;

    public String getFilename() {
        return this.filename;
    }
}
