#include <zmq.h>
#include <stdlib.h>
#include <stdio.h>
#include <unistd.h>
#include <string.h>

#include "model/ImageProvjera.pb-c.h"

#define Zahtjev Com__Emajliramokade__Image__Proto__Zahtjev
#define ZAHTJEV_INIT COM__EMAJLIRAMOKADE__IMAGE__PROTO__ZAHTJEV__INIT
#define zahtjev_get_packed_size com__emajliramokade__image__proto__zahtjev__get_packed_size
#define zahtjev_pack com__emajliramokade__image__proto__zahtjev__pack

int main (int argc, const char * argv [])
{

	void *context = zmq_ctx_new ();
	void *requester = zmq_socket (context, ZMQ_REQ);
	zmq_connect (requester, "tcp://localhost:7777");

    int request_nbr;
    for (request_nbr = 0; request_nbr != 100; request_nbr++) {
    	Zahtjev msg = ZAHTJEV_INIT;
        if (argc != 2)
	    {
	        fprintf(stderr,"Need 1 argument.\n");
	        return 1;
	    }

	    FILE *infile = fopen(argv[1], "r");
	    if (!infile)
	    {
	        fprintf(stderr, "File Not Found!\n");
	        return 2;
	    }

	    fseek(infile, 0, SEEK_END);
	    int image_size = ftell(infile);
	    fseek(infile, 0, SEEK_SET);

	    unsigned char *image_buffer = (unsigned char *) malloc(image_size);

	    if (!fread (image_buffer, image_size, 1, infile)) {
	        fprintf (stderr, "FCant open File!\n");
	        fclose (infile);
	        free (image_buffer);
	        return 4;   
	    }

	    fclose(infile);

	    msg.originalnaslika.data = image_buffer;
	    msg.originalnaslika.len = image_size;
	    int message_size = zahtjev_get_packed_size (&msg);

	    unsigned char *message_buffer = (unsigned char *) malloc (message_size);

	    zahtjev_pack (&msg, message_buffer);

		printf("Sent message size: %d", message_size);
		zmq_send (requester, message_buffer, message_size, 0);		

		sleep (1);
		char buffer[1000];
		int size = zmq_recv (requester, buffer, 1000, 0);

		printf ("Received response: ");
		printf (buffer);
		printf ("\n");
		free (message_buffer);
		free (image_buffer);
	}

	zmq_close (requester);
	zmq_ctx_destroy (context);
	return 0;
}