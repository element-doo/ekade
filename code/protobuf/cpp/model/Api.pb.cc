// Generated by the protocol buffer compiler.  DO NOT EDIT!
// source: model/Api.proto

#define INTERNAL_SUPPRESS_PROTOBUF_FIELD_DEPRECATION
#include "model/Api.pb.h"

#include <algorithm>

#include <google/protobuf/stubs/common.h>
#include <google/protobuf/stubs/once.h>
#include <google/protobuf/io/coded_stream.h>
#include <google/protobuf/wire_format_lite_inl.h>
#include <google/protobuf/descriptor.h>
#include <google/protobuf/generated_message_reflection.h>
#include <google/protobuf/reflection_ops.h>
#include <google/protobuf/wire_format.h>
// @@protoc_insertion_point(includes)

namespace Api {

namespace {

const ::google::protobuf::Descriptor* Zahtjev_descriptor_ = NULL;
const ::google::protobuf::internal::GeneratedMessageReflection*
  Zahtjev_reflection_ = NULL;
const ::google::protobuf::Descriptor* Odgovor_descriptor_ = NULL;
const ::google::protobuf::internal::GeneratedMessageReflection*
  Odgovor_reflection_ = NULL;

}  // namespace


void protobuf_AssignDesc_model_2fApi_2eproto() {
  protobuf_AddDesc_model_2fApi_2eproto();
  const ::google::protobuf::FileDescriptor* file =
    ::google::protobuf::DescriptorPool::generated_pool()->FindFileByName(
      "model/Api.proto");
  GOOGLE_CHECK(file != NULL);
  Zahtjev_descriptor_ = file->message_type(0);
  static const int Zahtjev_offsets_[2] = {
    GOOGLE_PROTOBUF_GENERATED_MESSAGE_FIELD_OFFSET(Zahtjev, email_),
    GOOGLE_PROTOBUF_GENERATED_MESSAGE_FIELD_OFFSET(Zahtjev, kadaid_),
  };
  Zahtjev_reflection_ =
    new ::google::protobuf::internal::GeneratedMessageReflection(
      Zahtjev_descriptor_,
      Zahtjev::default_instance_,
      Zahtjev_offsets_,
      GOOGLE_PROTOBUF_GENERATED_MESSAGE_FIELD_OFFSET(Zahtjev, _has_bits_[0]),
      GOOGLE_PROTOBUF_GENERATED_MESSAGE_FIELD_OFFSET(Zahtjev, _unknown_fields_),
      -1,
      ::google::protobuf::DescriptorPool::generated_pool(),
      ::google::protobuf::MessageFactory::generated_factory(),
      sizeof(Zahtjev));
  Odgovor_descriptor_ = file->message_type(1);
  static const int Odgovor_offsets_[2] = {
    GOOGLE_PROTOBUF_GENERATED_MESSAGE_FIELD_OFFSET(Odgovor, status_),
    GOOGLE_PROTOBUF_GENERATED_MESSAGE_FIELD_OFFSET(Odgovor, poruka_),
  };
  Odgovor_reflection_ =
    new ::google::protobuf::internal::GeneratedMessageReflection(
      Odgovor_descriptor_,
      Odgovor::default_instance_,
      Odgovor_offsets_,
      GOOGLE_PROTOBUF_GENERATED_MESSAGE_FIELD_OFFSET(Odgovor, _has_bits_[0]),
      GOOGLE_PROTOBUF_GENERATED_MESSAGE_FIELD_OFFSET(Odgovor, _unknown_fields_),
      -1,
      ::google::protobuf::DescriptorPool::generated_pool(),
      ::google::protobuf::MessageFactory::generated_factory(),
      sizeof(Odgovor));
}

namespace {

GOOGLE_PROTOBUF_DECLARE_ONCE(protobuf_AssignDescriptors_once_);
inline void protobuf_AssignDescriptorsOnce() {
  ::google::protobuf::GoogleOnceInit(&protobuf_AssignDescriptors_once_,
                 &protobuf_AssignDesc_model_2fApi_2eproto);
}

void protobuf_RegisterTypes(const ::std::string&) {
  protobuf_AssignDescriptorsOnce();
  ::google::protobuf::MessageFactory::InternalRegisterGeneratedMessage(
    Zahtjev_descriptor_, &Zahtjev::default_instance());
  ::google::protobuf::MessageFactory::InternalRegisterGeneratedMessage(
    Odgovor_descriptor_, &Odgovor::default_instance());
}

}  // namespace

void protobuf_ShutdownFile_model_2fApi_2eproto() {
  delete Zahtjev::default_instance_;
  delete Zahtjev_reflection_;
  delete Odgovor::default_instance_;
  delete Odgovor_reflection_;
}

void protobuf_AddDesc_model_2fApi_2eproto() {
  static bool already_here = false;
  if (already_here) return;
  already_here = true;
  GOOGLE_PROTOBUF_VERIFY_VERSION;

  ::google::protobuf::DescriptorPool::InternalAddGeneratedFile(
    "\n\017model/Api.proto\022\003Api\"(\n\007Zahtjev\022\r\n\005ema"
    "il\030\001 \002(\t\022\016\n\006kadaID\030\002 \001(\t\")\n\007Odgovor\022\016\n\006s"
    "tatus\030\001 \002(\010\022\016\n\006poruka\030\002 \002(\t", 107);
  ::google::protobuf::MessageFactory::InternalRegisterGeneratedFile(
    "model/Api.proto", &protobuf_RegisterTypes);
  Zahtjev::default_instance_ = new Zahtjev();
  Odgovor::default_instance_ = new Odgovor();
  Zahtjev::default_instance_->InitAsDefaultInstance();
  Odgovor::default_instance_->InitAsDefaultInstance();
  ::google::protobuf::internal::OnShutdown(&protobuf_ShutdownFile_model_2fApi_2eproto);
}

// Force AddDescriptors() to be called at static initialization time.
struct StaticDescriptorInitializer_model_2fApi_2eproto {
  StaticDescriptorInitializer_model_2fApi_2eproto() {
    protobuf_AddDesc_model_2fApi_2eproto();
  }
} static_descriptor_initializer_model_2fApi_2eproto_;

// ===================================================================

#ifndef _MSC_VER
const int Zahtjev::kEmailFieldNumber;
const int Zahtjev::kKadaIDFieldNumber;
#endif  // !_MSC_VER

Zahtjev::Zahtjev()
  : ::google::protobuf::Message() {
  SharedCtor();
}

void Zahtjev::InitAsDefaultInstance() {
}

Zahtjev::Zahtjev(const Zahtjev& from)
  : ::google::protobuf::Message() {
  SharedCtor();
  MergeFrom(from);
}

void Zahtjev::SharedCtor() {
  _cached_size_ = 0;
  email_ = const_cast< ::std::string*>(&::google::protobuf::internal::kEmptyString);
  kadaid_ = const_cast< ::std::string*>(&::google::protobuf::internal::kEmptyString);
  ::memset(_has_bits_, 0, sizeof(_has_bits_));
}

Zahtjev::~Zahtjev() {
  SharedDtor();
}

void Zahtjev::SharedDtor() {
  if (email_ != &::google::protobuf::internal::kEmptyString) {
    delete email_;
  }
  if (kadaid_ != &::google::protobuf::internal::kEmptyString) {
    delete kadaid_;
  }
  if (this != default_instance_) {
  }
}

void Zahtjev::SetCachedSize(int size) const {
  GOOGLE_SAFE_CONCURRENT_WRITES_BEGIN();
  _cached_size_ = size;
  GOOGLE_SAFE_CONCURRENT_WRITES_END();
}
const ::google::protobuf::Descriptor* Zahtjev::descriptor() {
  protobuf_AssignDescriptorsOnce();
  return Zahtjev_descriptor_;
}

const Zahtjev& Zahtjev::default_instance() {
  if (default_instance_ == NULL) protobuf_AddDesc_model_2fApi_2eproto();
  return *default_instance_;
}

Zahtjev* Zahtjev::default_instance_ = NULL;

Zahtjev* Zahtjev::New() const {
  return new Zahtjev;
}

void Zahtjev::Clear() {
  if (_has_bits_[0 / 32] & (0xffu << (0 % 32))) {
    if (has_email()) {
      if (email_ != &::google::protobuf::internal::kEmptyString) {
        email_->clear();
      }
    }
    if (has_kadaid()) {
      if (kadaid_ != &::google::protobuf::internal::kEmptyString) {
        kadaid_->clear();
      }
    }
  }
  ::memset(_has_bits_, 0, sizeof(_has_bits_));
  mutable_unknown_fields()->Clear();
}

bool Zahtjev::MergePartialFromCodedStream(
    ::google::protobuf::io::CodedInputStream* input) {
#define DO_(EXPRESSION) if (!(EXPRESSION)) return false
  ::google::protobuf::uint32 tag;
  while ((tag = input->ReadTag()) != 0) {
    switch (::google::protobuf::internal::WireFormatLite::GetTagFieldNumber(tag)) {
      // required string email = 1;
      case 1: {
        if (::google::protobuf::internal::WireFormatLite::GetTagWireType(tag) ==
            ::google::protobuf::internal::WireFormatLite::WIRETYPE_LENGTH_DELIMITED) {
          DO_(::google::protobuf::internal::WireFormatLite::ReadString(
                input, this->mutable_email()));
          ::google::protobuf::internal::WireFormat::VerifyUTF8String(
            this->email().data(), this->email().length(),
            ::google::protobuf::internal::WireFormat::PARSE);
        } else {
          goto handle_uninterpreted;
        }
        if (input->ExpectTag(18)) goto parse_kadaID;
        break;
      }

      // optional string kadaID = 2;
      case 2: {
        if (::google::protobuf::internal::WireFormatLite::GetTagWireType(tag) ==
            ::google::protobuf::internal::WireFormatLite::WIRETYPE_LENGTH_DELIMITED) {
         parse_kadaID:
          DO_(::google::protobuf::internal::WireFormatLite::ReadString(
                input, this->mutable_kadaid()));
          ::google::protobuf::internal::WireFormat::VerifyUTF8String(
            this->kadaid().data(), this->kadaid().length(),
            ::google::protobuf::internal::WireFormat::PARSE);
        } else {
          goto handle_uninterpreted;
        }
        if (input->ExpectAtEnd()) return true;
        break;
      }

      default: {
      handle_uninterpreted:
        if (::google::protobuf::internal::WireFormatLite::GetTagWireType(tag) ==
            ::google::protobuf::internal::WireFormatLite::WIRETYPE_END_GROUP) {
          return true;
        }
        DO_(::google::protobuf::internal::WireFormat::SkipField(
              input, tag, mutable_unknown_fields()));
        break;
      }
    }
  }
  return true;
#undef DO_
}

void Zahtjev::SerializeWithCachedSizes(
    ::google::protobuf::io::CodedOutputStream* output) const {
  // required string email = 1;
  if (has_email()) {
    ::google::protobuf::internal::WireFormat::VerifyUTF8String(
      this->email().data(), this->email().length(),
      ::google::protobuf::internal::WireFormat::SERIALIZE);
    ::google::protobuf::internal::WireFormatLite::WriteString(
      1, this->email(), output);
  }

  // optional string kadaID = 2;
  if (has_kadaid()) {
    ::google::protobuf::internal::WireFormat::VerifyUTF8String(
      this->kadaid().data(), this->kadaid().length(),
      ::google::protobuf::internal::WireFormat::SERIALIZE);
    ::google::protobuf::internal::WireFormatLite::WriteString(
      2, this->kadaid(), output);
  }

  if (!unknown_fields().empty()) {
    ::google::protobuf::internal::WireFormat::SerializeUnknownFields(
        unknown_fields(), output);
  }
}

::google::protobuf::uint8* Zahtjev::SerializeWithCachedSizesToArray(
    ::google::protobuf::uint8* target) const {
  // required string email = 1;
  if (has_email()) {
    ::google::protobuf::internal::WireFormat::VerifyUTF8String(
      this->email().data(), this->email().length(),
      ::google::protobuf::internal::WireFormat::SERIALIZE);
    target =
      ::google::protobuf::internal::WireFormatLite::WriteStringToArray(
        1, this->email(), target);
  }

  // optional string kadaID = 2;
  if (has_kadaid()) {
    ::google::protobuf::internal::WireFormat::VerifyUTF8String(
      this->kadaid().data(), this->kadaid().length(),
      ::google::protobuf::internal::WireFormat::SERIALIZE);
    target =
      ::google::protobuf::internal::WireFormatLite::WriteStringToArray(
        2, this->kadaid(), target);
  }

  if (!unknown_fields().empty()) {
    target = ::google::protobuf::internal::WireFormat::SerializeUnknownFieldsToArray(
        unknown_fields(), target);
  }
  return target;
}

int Zahtjev::ByteSize() const {
  int total_size = 0;

  if (_has_bits_[0 / 32] & (0xffu << (0 % 32))) {
    // required string email = 1;
    if (has_email()) {
      total_size += 1 +
        ::google::protobuf::internal::WireFormatLite::StringSize(
          this->email());
    }

    // optional string kadaID = 2;
    if (has_kadaid()) {
      total_size += 1 +
        ::google::protobuf::internal::WireFormatLite::StringSize(
          this->kadaid());
    }

  }
  if (!unknown_fields().empty()) {
    total_size +=
      ::google::protobuf::internal::WireFormat::ComputeUnknownFieldsSize(
        unknown_fields());
  }
  GOOGLE_SAFE_CONCURRENT_WRITES_BEGIN();
  _cached_size_ = total_size;
  GOOGLE_SAFE_CONCURRENT_WRITES_END();
  return total_size;
}

void Zahtjev::MergeFrom(const ::google::protobuf::Message& from) {
  GOOGLE_CHECK_NE(&from, this);
  const Zahtjev* source =
    ::google::protobuf::internal::dynamic_cast_if_available<const Zahtjev*>(
      &from);
  if (source == NULL) {
    ::google::protobuf::internal::ReflectionOps::Merge(from, this);
  } else {
    MergeFrom(*source);
  }
}

void Zahtjev::MergeFrom(const Zahtjev& from) {
  GOOGLE_CHECK_NE(&from, this);
  if (from._has_bits_[0 / 32] & (0xffu << (0 % 32))) {
    if (from.has_email()) {
      set_email(from.email());
    }
    if (from.has_kadaid()) {
      set_kadaid(from.kadaid());
    }
  }
  mutable_unknown_fields()->MergeFrom(from.unknown_fields());
}

void Zahtjev::CopyFrom(const ::google::protobuf::Message& from) {
  if (&from == this) return;
  Clear();
  MergeFrom(from);
}

void Zahtjev::CopyFrom(const Zahtjev& from) {
  if (&from == this) return;
  Clear();
  MergeFrom(from);
}

bool Zahtjev::IsInitialized() const {
  if ((_has_bits_[0] & 0x00000001) != 0x00000001) return false;

  return true;
}

void Zahtjev::Swap(Zahtjev* other) {
  if (other != this) {
    std::swap(email_, other->email_);
    std::swap(kadaid_, other->kadaid_);
    std::swap(_has_bits_[0], other->_has_bits_[0]);
    _unknown_fields_.Swap(&other->_unknown_fields_);
    std::swap(_cached_size_, other->_cached_size_);
  }
}

::google::protobuf::Metadata Zahtjev::GetMetadata() const {
  protobuf_AssignDescriptorsOnce();
  ::google::protobuf::Metadata metadata;
  metadata.descriptor = Zahtjev_descriptor_;
  metadata.reflection = Zahtjev_reflection_;
  return metadata;
}


// ===================================================================

#ifndef _MSC_VER
const int Odgovor::kStatusFieldNumber;
const int Odgovor::kPorukaFieldNumber;
#endif  // !_MSC_VER

Odgovor::Odgovor()
  : ::google::protobuf::Message() {
  SharedCtor();
}

void Odgovor::InitAsDefaultInstance() {
}

Odgovor::Odgovor(const Odgovor& from)
  : ::google::protobuf::Message() {
  SharedCtor();
  MergeFrom(from);
}

void Odgovor::SharedCtor() {
  _cached_size_ = 0;
  status_ = false;
  poruka_ = const_cast< ::std::string*>(&::google::protobuf::internal::kEmptyString);
  ::memset(_has_bits_, 0, sizeof(_has_bits_));
}

Odgovor::~Odgovor() {
  SharedDtor();
}

void Odgovor::SharedDtor() {
  if (poruka_ != &::google::protobuf::internal::kEmptyString) {
    delete poruka_;
  }
  if (this != default_instance_) {
  }
}

void Odgovor::SetCachedSize(int size) const {
  GOOGLE_SAFE_CONCURRENT_WRITES_BEGIN();
  _cached_size_ = size;
  GOOGLE_SAFE_CONCURRENT_WRITES_END();
}
const ::google::protobuf::Descriptor* Odgovor::descriptor() {
  protobuf_AssignDescriptorsOnce();
  return Odgovor_descriptor_;
}

const Odgovor& Odgovor::default_instance() {
  if (default_instance_ == NULL) protobuf_AddDesc_model_2fApi_2eproto();
  return *default_instance_;
}

Odgovor* Odgovor::default_instance_ = NULL;

Odgovor* Odgovor::New() const {
  return new Odgovor;
}

void Odgovor::Clear() {
  if (_has_bits_[0 / 32] & (0xffu << (0 % 32))) {
    status_ = false;
    if (has_poruka()) {
      if (poruka_ != &::google::protobuf::internal::kEmptyString) {
        poruka_->clear();
      }
    }
  }
  ::memset(_has_bits_, 0, sizeof(_has_bits_));
  mutable_unknown_fields()->Clear();
}

bool Odgovor::MergePartialFromCodedStream(
    ::google::protobuf::io::CodedInputStream* input) {
#define DO_(EXPRESSION) if (!(EXPRESSION)) return false
  ::google::protobuf::uint32 tag;
  while ((tag = input->ReadTag()) != 0) {
    switch (::google::protobuf::internal::WireFormatLite::GetTagFieldNumber(tag)) {
      // required bool status = 1;
      case 1: {
        if (::google::protobuf::internal::WireFormatLite::GetTagWireType(tag) ==
            ::google::protobuf::internal::WireFormatLite::WIRETYPE_VARINT) {
          DO_((::google::protobuf::internal::WireFormatLite::ReadPrimitive<
                   bool, ::google::protobuf::internal::WireFormatLite::TYPE_BOOL>(
                 input, &status_)));
          set_has_status();
        } else {
          goto handle_uninterpreted;
        }
        if (input->ExpectTag(18)) goto parse_poruka;
        break;
      }

      // required string poruka = 2;
      case 2: {
        if (::google::protobuf::internal::WireFormatLite::GetTagWireType(tag) ==
            ::google::protobuf::internal::WireFormatLite::WIRETYPE_LENGTH_DELIMITED) {
         parse_poruka:
          DO_(::google::protobuf::internal::WireFormatLite::ReadString(
                input, this->mutable_poruka()));
          ::google::protobuf::internal::WireFormat::VerifyUTF8String(
            this->poruka().data(), this->poruka().length(),
            ::google::protobuf::internal::WireFormat::PARSE);
        } else {
          goto handle_uninterpreted;
        }
        if (input->ExpectAtEnd()) return true;
        break;
      }

      default: {
      handle_uninterpreted:
        if (::google::protobuf::internal::WireFormatLite::GetTagWireType(tag) ==
            ::google::protobuf::internal::WireFormatLite::WIRETYPE_END_GROUP) {
          return true;
        }
        DO_(::google::protobuf::internal::WireFormat::SkipField(
              input, tag, mutable_unknown_fields()));
        break;
      }
    }
  }
  return true;
#undef DO_
}

void Odgovor::SerializeWithCachedSizes(
    ::google::protobuf::io::CodedOutputStream* output) const {
  // required bool status = 1;
  if (has_status()) {
    ::google::protobuf::internal::WireFormatLite::WriteBool(1, this->status(), output);
  }

  // required string poruka = 2;
  if (has_poruka()) {
    ::google::protobuf::internal::WireFormat::VerifyUTF8String(
      this->poruka().data(), this->poruka().length(),
      ::google::protobuf::internal::WireFormat::SERIALIZE);
    ::google::protobuf::internal::WireFormatLite::WriteString(
      2, this->poruka(), output);
  }

  if (!unknown_fields().empty()) {
    ::google::protobuf::internal::WireFormat::SerializeUnknownFields(
        unknown_fields(), output);
  }
}

::google::protobuf::uint8* Odgovor::SerializeWithCachedSizesToArray(
    ::google::protobuf::uint8* target) const {
  // required bool status = 1;
  if (has_status()) {
    target = ::google::protobuf::internal::WireFormatLite::WriteBoolToArray(1, this->status(), target);
  }

  // required string poruka = 2;
  if (has_poruka()) {
    ::google::protobuf::internal::WireFormat::VerifyUTF8String(
      this->poruka().data(), this->poruka().length(),
      ::google::protobuf::internal::WireFormat::SERIALIZE);
    target =
      ::google::protobuf::internal::WireFormatLite::WriteStringToArray(
        2, this->poruka(), target);
  }

  if (!unknown_fields().empty()) {
    target = ::google::protobuf::internal::WireFormat::SerializeUnknownFieldsToArray(
        unknown_fields(), target);
  }
  return target;
}

int Odgovor::ByteSize() const {
  int total_size = 0;

  if (_has_bits_[0 / 32] & (0xffu << (0 % 32))) {
    // required bool status = 1;
    if (has_status()) {
      total_size += 1 + 1;
    }

    // required string poruka = 2;
    if (has_poruka()) {
      total_size += 1 +
        ::google::protobuf::internal::WireFormatLite::StringSize(
          this->poruka());
    }

  }
  if (!unknown_fields().empty()) {
    total_size +=
      ::google::protobuf::internal::WireFormat::ComputeUnknownFieldsSize(
        unknown_fields());
  }
  GOOGLE_SAFE_CONCURRENT_WRITES_BEGIN();
  _cached_size_ = total_size;
  GOOGLE_SAFE_CONCURRENT_WRITES_END();
  return total_size;
}

void Odgovor::MergeFrom(const ::google::protobuf::Message& from) {
  GOOGLE_CHECK_NE(&from, this);
  const Odgovor* source =
    ::google::protobuf::internal::dynamic_cast_if_available<const Odgovor*>(
      &from);
  if (source == NULL) {
    ::google::protobuf::internal::ReflectionOps::Merge(from, this);
  } else {
    MergeFrom(*source);
  }
}

void Odgovor::MergeFrom(const Odgovor& from) {
  GOOGLE_CHECK_NE(&from, this);
  if (from._has_bits_[0 / 32] & (0xffu << (0 % 32))) {
    if (from.has_status()) {
      set_status(from.status());
    }
    if (from.has_poruka()) {
      set_poruka(from.poruka());
    }
  }
  mutable_unknown_fields()->MergeFrom(from.unknown_fields());
}

void Odgovor::CopyFrom(const ::google::protobuf::Message& from) {
  if (&from == this) return;
  Clear();
  MergeFrom(from);
}

void Odgovor::CopyFrom(const Odgovor& from) {
  if (&from == this) return;
  Clear();
  MergeFrom(from);
}

bool Odgovor::IsInitialized() const {
  if ((_has_bits_[0] & 0x00000003) != 0x00000003) return false;

  return true;
}

void Odgovor::Swap(Odgovor* other) {
  if (other != this) {
    std::swap(status_, other->status_);
    std::swap(poruka_, other->poruka_);
    std::swap(_has_bits_[0], other->_has_bits_[0]);
    _unknown_fields_.Swap(&other->_unknown_fields_);
    std::swap(_cached_size_, other->_cached_size_);
  }
}

::google::protobuf::Metadata Odgovor::GetMetadata() const {
  protobuf_AssignDescriptorsOnce();
  ::google::protobuf::Metadata metadata;
  metadata.descriptor = Odgovor_descriptor_;
  metadata.reflection = Odgovor_reflection_;
  return metadata;
}


// @@protoc_insertion_point(namespace_scope)

}  // namespace Api

// @@protoc_insertion_point(global_scope)
