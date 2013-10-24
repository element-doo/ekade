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

#define Dimenzije_Slike Com__Emajliramokade__Image__Proto__DimenzijeSlike
#define dimenzija_slike_init COM__EMAJLIRAMOKADE__IMAGE__PROTO__DIMENZIJE_SLIKE__INIT 
#define Odgovor Com__Emajliramokade__Image__Proto__Odgovor
#define odgovor_pack com__emajliramokade__image__proto__odgovor__pack
#define odgovor_get_packed_size com__emajliramokade__image__proto__odgovor__get_packed_size
#define odgovor_init COM__EMAJLIRAMOKADE__IMAGE__PROTO__ODGOVOR__INIT

int getImageMagickSize (const Zahtjev * z, Odgovor * o);

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
		printf ("Received message size: %d\n", len);
		Zahtjev * msg = zahtjev_unpack (NULL, len, buffer);

		Dimenzije_Slike ds = dimenzija_slike_init;
		Odgovor odgovor = odgovor_init;
		odgovor.dimenzijeslike = &ds;
		getImageMagickSize (msg, &odgovor);

		int message_size = odgovor_get_packed_size (&odgovor);
    	unsigned char *message_buffer = (unsigned char *) malloc (message_size);
    	odgovor_pack (&odgovor, message_buffer);
		
    	zmq_send (responder, message_buffer, message_size, 0);
    	printf ("Sent message size: %d\n", message_size);
    	printf ("Sent poruka: %s\n", odgovor.poruka);
	}
}


int getImageMagickSize (const Zahtjev * z, Odgovor * odgovor) {
	MagickWand *image_wand;	

	MagickWandGenesis();
	image_wand = NewMagickWand();

	MagickBooleanType status = MagickReadImageBlob (image_wand, z->originalnaslika.data, z->originalnaslika.len);
	if (status == MagickFalse) {
		odgovor->status =  0;
		odgovor->poruka = "MagickFalse";
		odgovor->dimenzijeslike = NULL;
		return 0;
	} else {
		printf("Magick running. \n");
	}

	odgovor->dimenzijeslike->width = MagickGetImageWidth (image_wand);
	odgovor->dimenzijeslike->height = MagickGetImageHeight (image_wand);
    
    image_wand = DestroyMagickWand (image_wand);
	MagickWandTerminus();
	odgovor->status = 1;
	odgovor->poruka = "Dimenzije Slike su...";
	return 1;
}
