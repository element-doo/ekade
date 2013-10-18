//server od clienta primi array bajtova preko kojeg ucita sliku, obradi sliku, posalje novi array bajtova clientu
#include <stdio.h>
//#include <unistd.h>
#include <string.h>
#include <stdlib.h>
#include <assert.h>
#include <wand/MagickWand.h>
#include <zmq.h>

typedef struct
{
	int height;
	int width;
	char format[5];
	size_t originalna_duljina_slike;
	unsigned char *polje;
}struktura_slike;

typedef struct
{
	size_t len;
	unsigned char *string;
}nova_slika;

int main (void)
 {
	 struktura_slike slika;
	 nova_slika nova;
     
	 
	 //   Socket to talk to clients
	 //________________________________________________//
     void *context = zmq_ctx_new ();
     void *responder = zmq_socket (context, ZMQ_REP);
     int rc = zmq_bind (responder, "tcp://*:5555");
     assert (rc == 0);
	 //________________________________________________//

	 
	//varijable
	 MagickWand	*image_wand;
	 MagickBooleanType status;

	 MagickWandGenesis();
	 image_wand = NewMagickWand();

	// printf("slika = %d..\n",sizeof(slika));
	// printf("%d\n",sizeof(slika.width));
	zmq_recv(responder,&slika,24,0);
	printf("Primljena struktura slika...\n");
	printf("height = %d\nwidth = %d\noriginalna_vel_slike = %d\nformat = %s\npolje = %d\n",slika.height,slika.width,slika.originalna_duljina_slike,slika.format,slika.polje);

	//____________CITANJE SLIKE_______I OBRADA SLIKE_________________________//
	status = MagickReadImageBlob(image_wand,slika.polje,slika.originalna_duljina_slike);
	if (status == MagickFalse)
					{printf("\nnevalja status\n"); exit(-1);}

	MagickAdaptiveResizeImage(image_wand, slika.width,slika.height); //promjena velicine

	MagickSetImageFormat(image_wand,slika.format);		//promjena formata

	nova.string = MagickWriteImageBlob(image_wand, &nova.len);  //ispis nove slike
	zmq_send(responder, &nova, 8, 0);	//slanje nove slike

     printf("poslana nova slika...\n");
	 
    image_wand = DestroyMagickWand(image_wand); 
	MagickWandTerminus();

	zmq_close (responder);
    zmq_ctx_destroy (context);
     return 0;
 }
