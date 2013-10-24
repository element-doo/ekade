//server od clienta primi array bajtova preko kojeg ucita sliku, obradi sliku, posalje novi array bajtova clientu
#include <stdio.h>
//#include <unistd.h>
#include <string.h>
#include <stdlib.h>
#include <assert.h>
#include <wand/MagickWand.h>
#include <zmq.h>

#define MAX_SIZE 26214400 //25MB


typedef struct
{
	int width;
	int height;
	int depth;
	char format[5];
}z;

typedef struct
{
	int broj_zahtjeva; //3 ili 4 ce bit
	z zhtv[4]; //jer je max zahtjeva 4 
}zahtjevi;


int main (void)
 {
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
	 unsigned char *string;

	 MagickWandGenesis();
	 image_wand = NewMagickWand();

	// printf("slika = %d..\n",sizeof(slika));
	// printf("%d\n",sizeof(slika.width));
	zmq_recv(responder,&slika,sizeof(slika),0);

	string = (unsigned char*)malloc(slika.originalna_duljina_slike);

	zmq_recv(responder,string,slika.originalna_duljina_slike,0);


	
	printf("Primljena struktura slika...\n");
	//printf("height = %d\nwidth = %d\noriginalna_vel_slike = %d\nformat = %s\npolje = %d\n",slika.height,slika.width,slika.originalna_duljina_slike,slika.format,slika.polje);


	//____________CITANJE SLIKE_______I OBRADA SLIKE_________________________//
	status = MagickReadImageBlob(image_wand,string,slika.originalna_duljina_slike);
	if (status == MagickFalse)
					{printf("\nnevalja status\n"); exit(-1);}

	MagickAdaptiveResizeImage(image_wand, slika.width,slika.height); //promjena velicine

	MagickSetImageFormat(image_wand,slika.format);		//promjena formata
	if( MagickSetImageDepth(image_wand, 8) == MagickTrue)
		printf("uspilo namistit depth\n");
	string = MagickWriteImageBlob(image_wand, &nova.len);  //ispis nove slike

	zmq_send(responder, &nova, sizeof(nova), ZMQ_SNDMORE);	//slanje nove slike
	zmq_send(responder, string, nova.len,0);
	free(string);

     printf("poslana nova slika...\n");
	 
    image_wand = DestroyMagickWand(image_wand); 
	MagickWandTerminus();

	zmq_close (responder);
    zmq_ctx_destroy (context);
     return 0;
 }
