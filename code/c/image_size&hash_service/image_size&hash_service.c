#include <zmq.h>
#include <wand/MagickWand.h>
#include <openssl/sha.h>
#include <stdio.h>
#include <stdlib.h>
#include <assert.h>

#include "model/ImageProvjera.pb-c.h"

#define POCKET_MAX_SIZE 1000000
#define HASH_BLOCK_SIZE 2048
#define SHA_DIGEST_LENGTH 20

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
int getSHA1 (const Zahtjev * z, Odgovor * odgovor);
int getSHA1Pixels (PixelIterator *iterator, Odgovor * odgovor);

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
	printf ("Service Running.\n");

	// Loop
	// º¤ø,¸¸,ø¤º°`°º¤
	while (1) {
		unsigned char digest [SHA_DIGEST_LENGTH];
		unsigned char buffer [POCKET_MAX_SIZE];

		int len = zmq_recv (responder, buffer, POCKET_MAX_SIZE, 0);
		printf ("Received message size: %d\n", len);
		Zahtjev * zahtjev = zahtjev_unpack (NULL, len, buffer);

		Dimenzije_Slike ds = dimenzija_slike_init;
		Odgovor odgovor = odgovor_init;
		odgovor.dimenzijeslike = &ds;
		odgovor.sha1bytes.data = SHA1 (zahtjev->originalnaslika.data, zahtjev->originalnaslika.len, NULL);
		odgovor.sha1bytes.len = SHA_DIGEST_LENGTH;

		odgovor.sha1pixels.data = (uint8_t *) &digest;
		getImageMagickSize (zahtjev, &odgovor);

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
		odgovor->poruka = "Image Magick nemoze otvoriti ovu sliku.";
		odgovor->dimenzijeslike = NULL;
		return 0;
	} else {
		printf ("Magick is processing image.\n");
	}

	PixelIterator *iterator = NewPixelIterator(image_wand);

	odgovor->dimenzijeslike->width = MagickGetImageWidth (image_wand);
	odgovor->dimenzijeslike->height = MagickGetImageHeight (image_wand);
	getSHA1Pixels(iterator, odgovor);
	odgovor->status = 1;
	odgovor->poruka = "Dimenzije slike najdene. ";

	DestroyPixelIterator (iterator);
	DestroyMagickWand (image_wand);
	MagickWandTerminus ();

	return 1;
}

int getSHA1Pixels (PixelIterator * iterator, Odgovor * odgovor) {
	SHA_CTX hash_pixel;
	SHA1_Init (&hash_pixel);

	PixelWand **pixels;
	MagickPixelPacket pixel;
	
	int counter = 0;
	int red, green, blue, alpha;
	int polje[SHA_DIGEST_LENGTH];
	size_t height, width;

	height = odgovor->dimenzijeslike->height;

	for (long y = 0; y < height; y++) {
		pixels = PixelGetNextIteratorRow (iterator, &width);

		if (pixels == NULL) {
			odgovor->status =  0;
			odgovor->poruka = "Greska u trazenju SHA1.";
			odgovor->dimenzijeslike = NULL;
			return 0;
			}

		for (long x = 0; x < (long) width; x++) {
			PixelGetMagickColor (pixels[x], &pixel);

			red = (int) pixel.red;
			green = (int) pixel.green;
			blue = (int) pixel.blue;
			alpha = 255 - (int) pixel.opacity;

			polje[counter] = (alpha << 24) + (red << 16) + (green << 8) + (blue);
			counter++;
			
			if (counter == SHA_DIGEST_LENGTH) {
				SHA1_Update (&hash_pixel, polje, SHA_DIGEST_LENGTH * sizeof(int));
				counter = 0;
			}
		}
	}
	SHA1_Update (&hash_pixel, polje, counter * (sizeof(int)));

	SHA1_Final (odgovor->sha1pixels.data, &hash_pixel);
	odgovor->has_sha1pixels = 1;
	odgovor->sha1pixels.len = SHA_DIGEST_LENGTH;
	return 1;
}
