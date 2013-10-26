package com.emajliramokade.api.model.Mailer;

public final class Attachment implements java.io.Serializable {
    public Attachment(
            final String fileName,
            final String mimeType,
            final byte[] bytes) {
        setFileName(fileName);
        setMimeType(mimeType);
        setBytes(bytes);
    }

    public Attachment() {
        this.fileName = "";
        this.mimeType = "";
        this.bytes = new byte[0];
    }

    @Override
    public int hashCode() {
        final int prime = 31;
        int result = 1;
        result = prime * result + 1498653219;
        result = prime * result
                + (this.fileName != null ? this.fileName.hashCode() : 0);
        result = prime * result
                + (this.mimeType != null ? this.mimeType.hashCode() : 0);
        result = prime * result + (java.util.Arrays.hashCode(this.bytes));
        return result;
    }

    @Override
    public boolean equals(final Object obj) {
        if (this == obj) return true;
        if (obj == null) return false;

        if (!(obj instanceof Attachment)) return false;
        final Attachment other = (Attachment) obj;

        if (!(this.fileName.equals(other.fileName))) return false;
        if (!(this.mimeType.equals(other.mimeType))) return false;
        if (!(java.util.Arrays.equals(this.bytes, other.bytes))) return false;

        return true;
    }

    @Override
    public String toString() {
        return "Attachment(" + fileName + ',' + mimeType + ',' + bytes + ')';
    }

    private static final long serialVersionUID = 0x0097000a;

    private String fileName;

    public String getFileName() {
        return fileName;
    }

    public Attachment setFileName(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"fileName\" cannot be null!");
        this.fileName = value;

        return this;
    }

    private String mimeType;

    public String getMimeType() {
        return mimeType;
    }

    public Attachment setMimeType(final String value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"mimeType\" cannot be null!");
        this.mimeType = value;

        return this;
    }

    private byte[] bytes;

    public byte[] getBytes() {
        return bytes;
    }

    public Attachment setBytes(final byte[] value) {
        if (value == null)
            throw new IllegalArgumentException(
                    "Property \"bytes\" cannot be null!");
        this.bytes = value;

        return this;
    }
}
