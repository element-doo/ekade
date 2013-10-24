//  client koji otvori sliku i šalje array bajtova, te kasnije primi novi array bajtova i spremi sliku
#include <zmq.h>
#include <stdlib.h>
#include <string.h>
#include <assert.h>
#include <stdio.h>
//#include <unistd.h>

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


int main(int argc,char **argv)
{	
	//_________________________________________________________ZMQ________//
    printf ("Connecting to imagemagick server...\n");
    void *context = zmq_ctx_new ();
    void *requester = zmq_socket (context, ZMQ_REQ);
	
	int rc = zmq_connect (requester, "tcp://localhost:5555");
	assert (rc == 0);
	

	//________________________________VARIJABLE________________________________________//
	FILE *pic, *kopija;
	unsigned char *polje, *string;
	int len, i, j, broj_zahtjeva;
	zahtjevi zahtjev;
	int novi_len;
	unsigned char *novi_string;

	
	//______________________________otvaranje slika, odreðivanje velicine originalne slike i citanje bajtova prve slike________//
	
	if((pic = fopen(argv[1],"rb")) == NULL)
	{
		printf("neuspjesno otvaranje slike, slika je prevelika\n");
		exit(1);
	}
	
	pic = fopen(argv[1],"rb");

	fseek(pic,0,SEEK_END);
	len = ftell(pic);

	if(len > MAX_SIZE)
	{
		printf("Max size of image is limited to 25 MB\n");
		exit(1);
	}

	fseek(pic,0,SEEK_SET);

	polje = (unsigned char*) malloc (len);

	fread(polje,1,len,pic);


	//________________upsi podataka u strukturu___________________//
	broj_zahtjeva = atoi(argv[2]);
	zahtjev.broj_zahtjeva = broj_zahtjeva;

	for(i = 0; i < broj_zahtjeva; i++)
	{
		zahtjev.zhtv[i].width = atoi(argv[3+i*4]);
		zahtjev.zhtv[i].height = atoi(argv[4+i*4]);
		zahtjev.zhtv[i].depth = atoi(argv[5+i*4]);
		strcpy(zahtjev.zhtv[i].format, argv[6+i*4]);
		for(j = 0; j < strlen(zahtjev.zhtv[i].format); j++)
			if(zahtjev.zhtv[i].format[j] == '0')
			    	zahtjev.zhtv[i].format[j] = '\0';
			


	}

	printf("%d\n",zahtjev.broj_zahtjeva);
	for(i = 0; i < broj_zahtjeva; i++)
	{
		printf("zahtjev.zhtv[%d].width = %d\n",i,zahtjev.zhtv[i].width);
		printf("zahtjev.zhtv[%d].height = %d\n",i,zahtjev.zhtv[i].height);
		printf("zahtjev.zhtv[%d].depth = %d\n",i,zahtjev.zhtv[i].depth);
		printf("zahtjev.zhtv[%d].format = %s\n",i,zahtjev.zhtv[i].format);
		printf("\n");
	}

	
	


	

//	printf("height = %d\nwidth = %d\noriginalna_vel_slike = %d\nformat = %s\npolje = %d\n",slika.height,slika.width,slika.originalna_duljina_slike,slika.format,slika.polje);


 
        printf ("Sending array...\n");
				
		
		//_____________SLANJE BAJTOVA____________________________________________//
		zmq_send (requester, &len, 4, ZMQ_SNDMORE); //posalje velicinu arraya bajtova
		zmq_send (requester, polje, len, ZMQ_SNDMORE); //posalje array bajtova
        printf("Poslan array bajtova\n");

		free(polje);
		polje = NULL;
		
		zmq_send (requester, &zahtjev, sizeof(zahtjev), 0); //poslani zahtjevi za resize slike

		zmq_recv (requester, &novi




		/*
		zmq_recv(requester,&nova,sizeof(nova),0);
		polje = (unsigned char*)malloc(nova.len);

		zmq_recv(requester, polje, nova.len, 0);

        printf("Primljen array bajtova\n");



		//_______________________________________ISPIS OBRADENE SLIKE________________//
		fwrite(polje,1,nova.len,kopija);
		printf ("Nova slika je kreirana...\n");
		free(polje);
    
	fclose(pic);
	fclose(kopija);
	printf("fclose obavljen\n");

    zmq_close (requester);
    zmq_ctx_destroy (context);
	// */
	fclose(pic);
	system("pause");
    return 0;
}
