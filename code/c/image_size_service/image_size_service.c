#include <zmq.h>
#include <wand/MagickWand.h>
#include <stdio.h>
#include <stdlib.h>
#include <assert.h>

#include "model/ImageProvjera.pb-c.h"

#define POCKET_MAX_SIZE 1000000

#define Zahtjev Com__Emajliramokade__Image__Proto__Zahtjev
#define zahtjev_unpack com__emajliramokade__image__proto__zahtjev__unpack
#define zahtjev_get_packed_size com__emajliramokade__image__proto__zahtjev__get_packed_size

#define Dimenzija_Slike Com__Emajliramokade__Image__Proto__DimenzijeSlike
#define dimenzija_Slike_Init COM__EMAJLIRAMOKADE__IMAGE__PROTO__DIMENZIJE_SLIKE__INIT
#define Odgovor Com__Emajliramokade__Image__Proto__Odogovor
#define odgovor_pack com__emajliramokade__image__proto__odgovor__pack


int main (int argc, const char * argv []) {

    // Setup 0MQ 
    // º¤ø,¸¸,ø¤º°`°º¤
    void *context = zmq_ctx_new ();
	void *responder = zmq_socket (context, ZMQ_REP);
	char responderTcp[19];
	
	if (argc > 2) {
        fprintf (stderr, "Too much arguments, only optionaly specifye port.\n");
        return 1;
	}

	if (argc == 2) {
		sprintf (responderTcp, "%s", argv[1]);
	} else {
		sprintf (responderTcp, "tcp://*:7777");
	}

	int rc = zmq_bind (responder, responderTcp);
	assert (rc == 0);

	// Loop
    // º¤ø,¸¸,ø¤º°`°º¤
	while (1) {
		unsigned char buffer [POCKET_MAX_SIZE];
		int len = zmq_recv (responder, buffer, POCKET_MAX_SIZE, 0);
		Zahtjev * msg = zahtjev_unpack (NULL, len, buffer);
		int message_size = zahtjev_get_packed_size(msg);
		Dimenzija_Slike

		printf("Received message size: %d\n", message_size);
		zmq_send (responder, "Pong", 4, 0);
	}
}

Dimenzija_Slike doMagick (Zahtjev z) {
	Dimenzija_Slike sd = dimenzija_Slike_Init;
	MagickWand	*image_wand;
	MagickBooleanType status;
	unsigned char buffer [z.originalnaslika.len];
	size_t width, height;

  
	MagickWandGenesis();
	image_wand = NewMagickWand();

	//buffer = (unsigned char*) malloc (z.orginalnaSlika.len);

	status = MagickReadImageBlob (image_wand, buffer, z.originalnaslika.len);
	if (status == MagickFalse) {
		printf("\nnevalja status\n"); exit(-1);
	}

	MagickGetSize (image_wand, &width, &height);
	sd.width = width;
	sd.height = height;
	free(buffer);

    image_wand = DestroyMagickWand (image_wand); 
	MagickWandTerminus();
    return sd;
}
