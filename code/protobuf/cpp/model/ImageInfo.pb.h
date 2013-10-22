// Generated by the protocol buffer compiler.  DO NOT EDIT!
// source: model/ImageInfo.proto

#ifndef PROTOBUF_model_2fImageInfo_2eproto__INCLUDED
#define PROTOBUF_model_2fImageInfo_2eproto__INCLUDED

#include <string>

#include <google/protobuf/stubs/common.h>

#if GOOGLE_PROTOBUF_VERSION < 2005000
#error This file was generated by a newer version of protoc which is
#error incompatible with your Protocol Buffer headers.  Please update
#error your headers.
#endif
#if 2005000 < GOOGLE_PROTOBUF_MIN_PROTOC_VERSION
#error This file was generated by an older version of protoc which is
#error incompatible with your Protocol Buffer headers.  Please
#error regenerate this file with a newer version of protoc.
#endif

#include <google/protobuf/generated_message_util.h>
#include <google/protobuf/message.h>
#include <google/protobuf/repeated_field.h>
#include <google/protobuf/extension_set.h>
#include <google/protobuf/unknown_field_set.h>
// @@protoc_insertion_point(includes)

namespace ImageInfo {

// Internal implementation detail -- do not call these.
void  protobuf_AddDesc_model_2fImageInfo_2eproto();
void protobuf_AssignDesc_model_2fImageInfo_2eproto();
void protobuf_ShutdownFile_model_2fImageInfo_2eproto();

class DimenzijaSlike;
class Zahtjev;
class Odgovor;

// ===================================================================

class DimenzijaSlike : public ::google::protobuf::Message {
 public:
  DimenzijaSlike();
  virtual ~DimenzijaSlike();

  DimenzijaSlike(const DimenzijaSlike& from);

  inline DimenzijaSlike& operator=(const DimenzijaSlike& from) {
    CopyFrom(from);
    return *this;
  }

  inline const ::google::protobuf::UnknownFieldSet& unknown_fields() const {
    return _unknown_fields_;
  }

  inline ::google::protobuf::UnknownFieldSet* mutable_unknown_fields() {
    return &_unknown_fields_;
  }

  static const ::google::protobuf::Descriptor* descriptor();
  static const DimenzijaSlike& default_instance();

  void Swap(DimenzijaSlike* other);

  // implements Message ----------------------------------------------

  DimenzijaSlike* New() const;
  void CopyFrom(const ::google::protobuf::Message& from);
  void MergeFrom(const ::google::protobuf::Message& from);
  void CopyFrom(const DimenzijaSlike& from);
  void MergeFrom(const DimenzijaSlike& from);
  void Clear();
  bool IsInitialized() const;

  int ByteSize() const;
  bool MergePartialFromCodedStream(
      ::google::protobuf::io::CodedInputStream* input);
  void SerializeWithCachedSizes(
      ::google::protobuf::io::CodedOutputStream* output) const;
  ::google::protobuf::uint8* SerializeWithCachedSizesToArray(::google::protobuf::uint8* output) const;
  int GetCachedSize() const { return _cached_size_; }
  private:
  void SharedCtor();
  void SharedDtor();
  void SetCachedSize(int size) const;
  public:

  ::google::protobuf::Metadata GetMetadata() const;

  // nested types ----------------------------------------------------

  // accessors -------------------------------------------------------

  // required uint32 width = 1;
  inline bool has_width() const;
  inline void clear_width();
  static const int kWidthFieldNumber = 1;
  inline ::google::protobuf::uint32 width() const;
  inline void set_width(::google::protobuf::uint32 value);

  // required uint32 height = 2;
  inline bool has_height() const;
  inline void clear_height();
  static const int kHeightFieldNumber = 2;
  inline ::google::protobuf::uint32 height() const;
  inline void set_height(::google::protobuf::uint32 value);

  // @@protoc_insertion_point(class_scope:ImageInfo.DimenzijaSlike)
 private:
  inline void set_has_width();
  inline void clear_has_width();
  inline void set_has_height();
  inline void clear_has_height();

  ::google::protobuf::UnknownFieldSet _unknown_fields_;

  ::google::protobuf::uint32 width_;
  ::google::protobuf::uint32 height_;

  mutable int _cached_size_;
  ::google::protobuf::uint32 _has_bits_[(2 + 31) / 32];

  friend void  protobuf_AddDesc_model_2fImageInfo_2eproto();
  friend void protobuf_AssignDesc_model_2fImageInfo_2eproto();
  friend void protobuf_ShutdownFile_model_2fImageInfo_2eproto();

  void InitAsDefaultInstance();
  static DimenzijaSlike* default_instance_;
};
// -------------------------------------------------------------------

class Zahtjev : public ::google::protobuf::Message {
 public:
  Zahtjev();
  virtual ~Zahtjev();

  Zahtjev(const Zahtjev& from);

  inline Zahtjev& operator=(const Zahtjev& from) {
    CopyFrom(from);
    return *this;
  }

  inline const ::google::protobuf::UnknownFieldSet& unknown_fields() const {
    return _unknown_fields_;
  }

  inline ::google::protobuf::UnknownFieldSet* mutable_unknown_fields() {
    return &_unknown_fields_;
  }

  static const ::google::protobuf::Descriptor* descriptor();
  static const Zahtjev& default_instance();

  void Swap(Zahtjev* other);

  // implements Message ----------------------------------------------

  Zahtjev* New() const;
  void CopyFrom(const ::google::protobuf::Message& from);
  void MergeFrom(const ::google::protobuf::Message& from);
  void CopyFrom(const Zahtjev& from);
  void MergeFrom(const Zahtjev& from);
  void Clear();
  bool IsInitialized() const;

  int ByteSize() const;
  bool MergePartialFromCodedStream(
      ::google::protobuf::io::CodedInputStream* input);
  void SerializeWithCachedSizes(
      ::google::protobuf::io::CodedOutputStream* output) const;
  ::google::protobuf::uint8* SerializeWithCachedSizesToArray(::google::protobuf::uint8* output) const;
  int GetCachedSize() const { return _cached_size_; }
  private:
  void SharedCtor();
  void SharedDtor();
  void SetCachedSize(int size) const;
  public:

  ::google::protobuf::Metadata GetMetadata() const;

  // nested types ----------------------------------------------------

  // accessors -------------------------------------------------------

  // required uint32 velicinaSlike = 1;
  inline bool has_velicinaslike() const;
  inline void clear_velicinaslike();
  static const int kVelicinaSlikeFieldNumber = 1;
  inline ::google::protobuf::uint32 velicinaslike() const;
  inline void set_velicinaslike(::google::protobuf::uint32 value);

  // required bytes originalnaSlika = 2;
  inline bool has_originalnaslika() const;
  inline void clear_originalnaslika();
  static const int kOriginalnaSlikaFieldNumber = 2;
  inline const ::std::string& originalnaslika() const;
  inline void set_originalnaslika(const ::std::string& value);
  inline void set_originalnaslika(const char* value);
  inline void set_originalnaslika(const void* value, size_t size);
  inline ::std::string* mutable_originalnaslika();
  inline ::std::string* release_originalnaslika();
  inline void set_allocated_originalnaslika(::std::string* originalnaslika);

  // @@protoc_insertion_point(class_scope:ImageInfo.Zahtjev)
 private:
  inline void set_has_velicinaslike();
  inline void clear_has_velicinaslike();
  inline void set_has_originalnaslika();
  inline void clear_has_originalnaslika();

  ::google::protobuf::UnknownFieldSet _unknown_fields_;

  ::std::string* originalnaslika_;
  ::google::protobuf::uint32 velicinaslike_;

  mutable int _cached_size_;
  ::google::protobuf::uint32 _has_bits_[(2 + 31) / 32];

  friend void  protobuf_AddDesc_model_2fImageInfo_2eproto();
  friend void protobuf_AssignDesc_model_2fImageInfo_2eproto();
  friend void protobuf_ShutdownFile_model_2fImageInfo_2eproto();

  void InitAsDefaultInstance();
  static Zahtjev* default_instance_;
};
// -------------------------------------------------------------------

class Odgovor : public ::google::protobuf::Message {
 public:
  Odgovor();
  virtual ~Odgovor();

  Odgovor(const Odgovor& from);

  inline Odgovor& operator=(const Odgovor& from) {
    CopyFrom(from);
    return *this;
  }

  inline const ::google::protobuf::UnknownFieldSet& unknown_fields() const {
    return _unknown_fields_;
  }

  inline ::google::protobuf::UnknownFieldSet* mutable_unknown_fields() {
    return &_unknown_fields_;
  }

  static const ::google::protobuf::Descriptor* descriptor();
  static const Odgovor& default_instance();

  void Swap(Odgovor* other);

  // implements Message ----------------------------------------------

  Odgovor* New() const;
  void CopyFrom(const ::google::protobuf::Message& from);
  void MergeFrom(const ::google::protobuf::Message& from);
  void CopyFrom(const Odgovor& from);
  void MergeFrom(const Odgovor& from);
  void Clear();
  bool IsInitialized() const;

  int ByteSize() const;
  bool MergePartialFromCodedStream(
      ::google::protobuf::io::CodedInputStream* input);
  void SerializeWithCachedSizes(
      ::google::protobuf::io::CodedOutputStream* output) const;
  ::google::protobuf::uint8* SerializeWithCachedSizesToArray(::google::protobuf::uint8* output) const;
  int GetCachedSize() const { return _cached_size_; }
  private:
  void SharedCtor();
  void SharedDtor();
  void SetCachedSize(int size) const;
  public:

  ::google::protobuf::Metadata GetMetadata() const;

  // nested types ----------------------------------------------------

  // accessors -------------------------------------------------------

  // required bool status = 1;
  inline bool has_status() const;
  inline void clear_status();
  static const int kStatusFieldNumber = 1;
  inline bool status() const;
  inline void set_status(bool value);

  // required string poruka = 2;
  inline bool has_poruka() const;
  inline void clear_poruka();
  static const int kPorukaFieldNumber = 2;
  inline const ::std::string& poruka() const;
  inline void set_poruka(const ::std::string& value);
  inline void set_poruka(const char* value);
  inline void set_poruka(const char* value, size_t size);
  inline ::std::string* mutable_poruka();
  inline ::std::string* release_poruka();
  inline void set_allocated_poruka(::std::string* poruka);

  // optional .ImageInfo.DimenzijaSlike velicinaSlike = 3;
  inline bool has_velicinaslike() const;
  inline void clear_velicinaslike();
  static const int kVelicinaSlikeFieldNumber = 3;
  inline const ::ImageInfo::DimenzijaSlike& velicinaslike() const;
  inline ::ImageInfo::DimenzijaSlike* mutable_velicinaslike();
  inline ::ImageInfo::DimenzijaSlike* release_velicinaslike();
  inline void set_allocated_velicinaslike(::ImageInfo::DimenzijaSlike* velicinaslike);

  // @@protoc_insertion_point(class_scope:ImageInfo.Odgovor)
 private:
  inline void set_has_status();
  inline void clear_has_status();
  inline void set_has_poruka();
  inline void clear_has_poruka();
  inline void set_has_velicinaslike();
  inline void clear_has_velicinaslike();

  ::google::protobuf::UnknownFieldSet _unknown_fields_;

  ::std::string* poruka_;
  ::ImageInfo::DimenzijaSlike* velicinaslike_;
  bool status_;

  mutable int _cached_size_;
  ::google::protobuf::uint32 _has_bits_[(3 + 31) / 32];

  friend void  protobuf_AddDesc_model_2fImageInfo_2eproto();
  friend void protobuf_AssignDesc_model_2fImageInfo_2eproto();
  friend void protobuf_ShutdownFile_model_2fImageInfo_2eproto();

  void InitAsDefaultInstance();
  static Odgovor* default_instance_;
};
// ===================================================================


// ===================================================================

// DimenzijaSlike

// required uint32 width = 1;
inline bool DimenzijaSlike::has_width() const {
  return (_has_bits_[0] & 0x00000001u) != 0;
}
inline void DimenzijaSlike::set_has_width() {
  _has_bits_[0] |= 0x00000001u;
}
inline void DimenzijaSlike::clear_has_width() {
  _has_bits_[0] &= ~0x00000001u;
}
inline void DimenzijaSlike::clear_width() {
  width_ = 0u;
  clear_has_width();
}
inline ::google::protobuf::uint32 DimenzijaSlike::width() const {
  return width_;
}
inline void DimenzijaSlike::set_width(::google::protobuf::uint32 value) {
  set_has_width();
  width_ = value;
}

// required uint32 height = 2;
inline bool DimenzijaSlike::has_height() const {
  return (_has_bits_[0] & 0x00000002u) != 0;
}
inline void DimenzijaSlike::set_has_height() {
  _has_bits_[0] |= 0x00000002u;
}
inline void DimenzijaSlike::clear_has_height() {
  _has_bits_[0] &= ~0x00000002u;
}
inline void DimenzijaSlike::clear_height() {
  height_ = 0u;
  clear_has_height();
}
inline ::google::protobuf::uint32 DimenzijaSlike::height() const {
  return height_;
}
inline void DimenzijaSlike::set_height(::google::protobuf::uint32 value) {
  set_has_height();
  height_ = value;
}

// -------------------------------------------------------------------

// Zahtjev

// required uint32 velicinaSlike = 1;
inline bool Zahtjev::has_velicinaslike() const {
  return (_has_bits_[0] & 0x00000001u) != 0;
}
inline void Zahtjev::set_has_velicinaslike() {
  _has_bits_[0] |= 0x00000001u;
}
inline void Zahtjev::clear_has_velicinaslike() {
  _has_bits_[0] &= ~0x00000001u;
}
inline void Zahtjev::clear_velicinaslike() {
  velicinaslike_ = 0u;
  clear_has_velicinaslike();
}
inline ::google::protobuf::uint32 Zahtjev::velicinaslike() const {
  return velicinaslike_;
}
inline void Zahtjev::set_velicinaslike(::google::protobuf::uint32 value) {
  set_has_velicinaslike();
  velicinaslike_ = value;
}

// required bytes originalnaSlika = 2;
inline bool Zahtjev::has_originalnaslika() const {
  return (_has_bits_[0] & 0x00000002u) != 0;
}
inline void Zahtjev::set_has_originalnaslika() {
  _has_bits_[0] |= 0x00000002u;
}
inline void Zahtjev::clear_has_originalnaslika() {
  _has_bits_[0] &= ~0x00000002u;
}
inline void Zahtjev::clear_originalnaslika() {
  if (originalnaslika_ != &::google::protobuf::internal::kEmptyString) {
    originalnaslika_->clear();
  }
  clear_has_originalnaslika();
}
inline const ::std::string& Zahtjev::originalnaslika() const {
  return *originalnaslika_;
}
inline void Zahtjev::set_originalnaslika(const ::std::string& value) {
  set_has_originalnaslika();
  if (originalnaslika_ == &::google::protobuf::internal::kEmptyString) {
    originalnaslika_ = new ::std::string;
  }
  originalnaslika_->assign(value);
}
inline void Zahtjev::set_originalnaslika(const char* value) {
  set_has_originalnaslika();
  if (originalnaslika_ == &::google::protobuf::internal::kEmptyString) {
    originalnaslika_ = new ::std::string;
  }
  originalnaslika_->assign(value);
}
inline void Zahtjev::set_originalnaslika(const void* value, size_t size) {
  set_has_originalnaslika();
  if (originalnaslika_ == &::google::protobuf::internal::kEmptyString) {
    originalnaslika_ = new ::std::string;
  }
  originalnaslika_->assign(reinterpret_cast<const char*>(value), size);
}
inline ::std::string* Zahtjev::mutable_originalnaslika() {
  set_has_originalnaslika();
  if (originalnaslika_ == &::google::protobuf::internal::kEmptyString) {
    originalnaslika_ = new ::std::string;
  }
  return originalnaslika_;
}
inline ::std::string* Zahtjev::release_originalnaslika() {
  clear_has_originalnaslika();
  if (originalnaslika_ == &::google::protobuf::internal::kEmptyString) {
    return NULL;
  } else {
    ::std::string* temp = originalnaslika_;
    originalnaslika_ = const_cast< ::std::string*>(&::google::protobuf::internal::kEmptyString);
    return temp;
  }
}
inline void Zahtjev::set_allocated_originalnaslika(::std::string* originalnaslika) {
  if (originalnaslika_ != &::google::protobuf::internal::kEmptyString) {
    delete originalnaslika_;
  }
  if (originalnaslika) {
    set_has_originalnaslika();
    originalnaslika_ = originalnaslika;
  } else {
    clear_has_originalnaslika();
    originalnaslika_ = const_cast< ::std::string*>(&::google::protobuf::internal::kEmptyString);
  }
}

// -------------------------------------------------------------------

// Odgovor

// required bool status = 1;
inline bool Odgovor::has_status() const {
  return (_has_bits_[0] & 0x00000001u) != 0;
}
inline void Odgovor::set_has_status() {
  _has_bits_[0] |= 0x00000001u;
}
inline void Odgovor::clear_has_status() {
  _has_bits_[0] &= ~0x00000001u;
}
inline void Odgovor::clear_status() {
  status_ = false;
  clear_has_status();
}
inline bool Odgovor::status() const {
  return status_;
}
inline void Odgovor::set_status(bool value) {
  set_has_status();
  status_ = value;
}

// required string poruka = 2;
inline bool Odgovor::has_poruka() const {
  return (_has_bits_[0] & 0x00000002u) != 0;
}
inline void Odgovor::set_has_poruka() {
  _has_bits_[0] |= 0x00000002u;
}
inline void Odgovor::clear_has_poruka() {
  _has_bits_[0] &= ~0x00000002u;
}
inline void Odgovor::clear_poruka() {
  if (poruka_ != &::google::protobuf::internal::kEmptyString) {
    poruka_->clear();
  }
  clear_has_poruka();
}
inline const ::std::string& Odgovor::poruka() const {
  return *poruka_;
}
inline void Odgovor::set_poruka(const ::std::string& value) {
  set_has_poruka();
  if (poruka_ == &::google::protobuf::internal::kEmptyString) {
    poruka_ = new ::std::string;
  }
  poruka_->assign(value);
}
inline void Odgovor::set_poruka(const char* value) {
  set_has_poruka();
  if (poruka_ == &::google::protobuf::internal::kEmptyString) {
    poruka_ = new ::std::string;
  }
  poruka_->assign(value);
}
inline void Odgovor::set_poruka(const char* value, size_t size) {
  set_has_poruka();
  if (poruka_ == &::google::protobuf::internal::kEmptyString) {
    poruka_ = new ::std::string;
  }
  poruka_->assign(reinterpret_cast<const char*>(value), size);
}
inline ::std::string* Odgovor::mutable_poruka() {
  set_has_poruka();
  if (poruka_ == &::google::protobuf::internal::kEmptyString) {
    poruka_ = new ::std::string;
  }
  return poruka_;
}
inline ::std::string* Odgovor::release_poruka() {
  clear_has_poruka();
  if (poruka_ == &::google::protobuf::internal::kEmptyString) {
    return NULL;
  } else {
    ::std::string* temp = poruka_;
    poruka_ = const_cast< ::std::string*>(&::google::protobuf::internal::kEmptyString);
    return temp;
  }
}
inline void Odgovor::set_allocated_poruka(::std::string* poruka) {
  if (poruka_ != &::google::protobuf::internal::kEmptyString) {
    delete poruka_;
  }
  if (poruka) {
    set_has_poruka();
    poruka_ = poruka;
  } else {
    clear_has_poruka();
    poruka_ = const_cast< ::std::string*>(&::google::protobuf::internal::kEmptyString);
  }
}

// optional .ImageInfo.DimenzijaSlike velicinaSlike = 3;
inline bool Odgovor::has_velicinaslike() const {
  return (_has_bits_[0] & 0x00000004u) != 0;
}
inline void Odgovor::set_has_velicinaslike() {
  _has_bits_[0] |= 0x00000004u;
}
inline void Odgovor::clear_has_velicinaslike() {
  _has_bits_[0] &= ~0x00000004u;
}
inline void Odgovor::clear_velicinaslike() {
  if (velicinaslike_ != NULL) velicinaslike_->::ImageInfo::DimenzijaSlike::Clear();
  clear_has_velicinaslike();
}
inline const ::ImageInfo::DimenzijaSlike& Odgovor::velicinaslike() const {
  return velicinaslike_ != NULL ? *velicinaslike_ : *default_instance_->velicinaslike_;
}
inline ::ImageInfo::DimenzijaSlike* Odgovor::mutable_velicinaslike() {
  set_has_velicinaslike();
  if (velicinaslike_ == NULL) velicinaslike_ = new ::ImageInfo::DimenzijaSlike;
  return velicinaslike_;
}
inline ::ImageInfo::DimenzijaSlike* Odgovor::release_velicinaslike() {
  clear_has_velicinaslike();
  ::ImageInfo::DimenzijaSlike* temp = velicinaslike_;
  velicinaslike_ = NULL;
  return temp;
}
inline void Odgovor::set_allocated_velicinaslike(::ImageInfo::DimenzijaSlike* velicinaslike) {
  delete velicinaslike_;
  velicinaslike_ = velicinaslike;
  if (velicinaslike) {
    set_has_velicinaslike();
  } else {
    clear_has_velicinaslike();
  }
}


// @@protoc_insertion_point(namespace_scope)

}  // namespace ImageInfo

#ifndef SWIG
namespace google {
namespace protobuf {


}  // namespace google
}  // namespace protobuf
#endif  // SWIG

// @@protoc_insertion_point(global_scope)

#endif  // PROTOBUF_model_2fImageInfo_2eproto__INCLUDED
