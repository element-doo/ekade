/* Generated by the protocol buffer compiler.  DO NOT EDIT! */

#ifndef PROTOBUF_C_model_2fEmailProvjera_2eproto__INCLUDED
#define PROTOBUF_C_model_2fEmailProvjera_2eproto__INCLUDED

#include <google/protobuf-c/protobuf-c.h>

PROTOBUF_C_BEGIN_DECLS


typedef struct _Com__Emajliramokade__Email__Proto__Zahtjev Com__Emajliramokade__Email__Proto__Zahtjev;
typedef struct _Com__Emajliramokade__Email__Proto__Odgovor Com__Emajliramokade__Email__Proto__Odgovor;


/* --- enums --- */


/* --- messages --- */

struct  _Com__Emajliramokade__Email__Proto__Zahtjev
{
  ProtobufCMessage base;
  char *email;
  char *kadaid;
};
#define COM__EMAJLIRAMOKADE__EMAIL__PROTO__ZAHTJEV__INIT \
 { PROTOBUF_C_MESSAGE_INIT (&com__emajliramokade__email__proto__zahtjev__descriptor) \
    , NULL, NULL }


struct  _Com__Emajliramokade__Email__Proto__Odgovor
{
  ProtobufCMessage base;
  protobuf_c_boolean status;
  char *poruka;
};
#define COM__EMAJLIRAMOKADE__EMAIL__PROTO__ODGOVOR__INIT \
 { PROTOBUF_C_MESSAGE_INIT (&com__emajliramokade__email__proto__odgovor__descriptor) \
    , 0, NULL }


/* Com__Emajliramokade__Email__Proto__Zahtjev methods */
void   com__emajliramokade__email__proto__zahtjev__init
                     (Com__Emajliramokade__Email__Proto__Zahtjev         *message);
size_t com__emajliramokade__email__proto__zahtjev__get_packed_size
                     (const Com__Emajliramokade__Email__Proto__Zahtjev   *message);
size_t com__emajliramokade__email__proto__zahtjev__pack
                     (const Com__Emajliramokade__Email__Proto__Zahtjev   *message,
                      uint8_t             *out);
size_t com__emajliramokade__email__proto__zahtjev__pack_to_buffer
                     (const Com__Emajliramokade__Email__Proto__Zahtjev   *message,
                      ProtobufCBuffer     *buffer);
Com__Emajliramokade__Email__Proto__Zahtjev *
       com__emajliramokade__email__proto__zahtjev__unpack
                     (ProtobufCAllocator  *allocator,
                      size_t               len,
                      const uint8_t       *data);
void   com__emajliramokade__email__proto__zahtjev__free_unpacked
                     (Com__Emajliramokade__Email__Proto__Zahtjev *message,
                      ProtobufCAllocator *allocator);
/* Com__Emajliramokade__Email__Proto__Odgovor methods */
void   com__emajliramokade__email__proto__odgovor__init
                     (Com__Emajliramokade__Email__Proto__Odgovor         *message);
size_t com__emajliramokade__email__proto__odgovor__get_packed_size
                     (const Com__Emajliramokade__Email__Proto__Odgovor   *message);
size_t com__emajliramokade__email__proto__odgovor__pack
                     (const Com__Emajliramokade__Email__Proto__Odgovor   *message,
                      uint8_t             *out);
size_t com__emajliramokade__email__proto__odgovor__pack_to_buffer
                     (const Com__Emajliramokade__Email__Proto__Odgovor   *message,
                      ProtobufCBuffer     *buffer);
Com__Emajliramokade__Email__Proto__Odgovor *
       com__emajliramokade__email__proto__odgovor__unpack
                     (ProtobufCAllocator  *allocator,
                      size_t               len,
                      const uint8_t       *data);
void   com__emajliramokade__email__proto__odgovor__free_unpacked
                     (Com__Emajliramokade__Email__Proto__Odgovor *message,
                      ProtobufCAllocator *allocator);
/* --- per-message closures --- */

typedef void (*Com__Emajliramokade__Email__Proto__Zahtjev_Closure)
                 (const Com__Emajliramokade__Email__Proto__Zahtjev *message,
                  void *closure_data);
typedef void (*Com__Emajliramokade__Email__Proto__Odgovor_Closure)
                 (const Com__Emajliramokade__Email__Proto__Odgovor *message,
                  void *closure_data);

/* --- services --- */


/* --- descriptors --- */

extern const ProtobufCMessageDescriptor com__emajliramokade__email__proto__zahtjev__descriptor;
extern const ProtobufCMessageDescriptor com__emajliramokade__email__proto__odgovor__descriptor;

PROTOBUF_C_END_DECLS


#endif  /* PROTOBUF_model_2fEmailProvjera_2eproto__INCLUDED */
