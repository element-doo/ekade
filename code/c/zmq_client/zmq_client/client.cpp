//  client koji otvori sliku i šalje array bajtova, te kasnije primi novi array bajtova i spremi sliku
#include <zmq.h>
#include <stdlib.h>
#include <string.h>
#include <stdio.h>
//#include <unistd.h>

typedef struct
{
	int height;
	int width;
	char format[5]; //13bajta do ovde
	size_t originalna_duljina_slike;
	unsigned char *polje;
}struktura_slike;

typedef struct
{
	size_t len;
	unsigned char *string;
}nova_slika;


int main(int argc,char **argv)
{	//________________________________-provjera argumenata______________________________________________//
	if(argc != 6)
	{
		printf("Poziv treba izgledati:\n\nzmq_client.exe ime_slike.ext kopija.ext zeljeni_height zeljeni_width zeljeni_format!!!");
		exit(1);
	}

	//_________________________________________________________ZMQ________//
    printf ("Connecting to imagemagick server...\n");
    void *context = zmq_ctx_new ();
    void *requester = zmq_socket (context, ZMQ_REQ);
    zmq_connect (requester, "tcp://localhost:5555");
	


	//________________________________VARIJABLE________________________________________//
	
	
	struktura_slike slika;
	nova_slika nova;
	FILE *pic, *kopija;
	int len;
	

	//______________________________otvaranje slika, odreðivanje velicine originalne slike i citanje bajtova prve slike________//
	pic = fopen(argv[1],"rb");
	kopija = fopen(argv[2], "wb");

	fseek(pic,0,SEEK_END);
	len = ftell(pic);
	fseek(pic,0,SEEK_SET);


	slika.polje = (unsigned char*) malloc (len);
	fread(slika.polje,1,len,pic);


	//________________upsi podataka u strukturu___________________//
	slika.height = atoi(argv[3]);
	slika.width = atoi(argv[4]);
	strcpy(slika.format,argv[5]);
	slika.format[4] = '\0';        //xxxx\0  
	if(strlen(argv[5]) == 3)		
		slika.format[3] = '\0';		//xxx\0
	slika.originalna_duljina_slike = len;

	printf("height = %d\nwidth = %d\noriginalna_vel_slike = %d\nformat = %s\npolje = %d\n",slika.height,slika.width,slika.originalna_duljina_slike,slika.format,slika.polje);


 
        printf ("Sending array...\n");
				
		
		//_____________SLANJE BAJTOVA____________________________________________//
		zmq_send (requester, &slika, 24, 0); //posalje array bajtova serveru
        printf("Poslan array bajtova\n");
		free(slika.polje);

		
		
		zmq_recv(requester,&nova,8,0);
        printf("Primljen array bajtova\n");


		//_______________________________________ISPIS OBRADENE SLIKE________________//
		fwrite(nova.string,1,nova.len,kopija);
		free(nova.string);
		printf ("Nova slika je kreirana...\n");
    
	fclose(pic);
	fclose(kopija);
	printf("fclose obavljen\n");

    zmq_close (requester);
    zmq_ctx_destroy (context);
	system("pause");
    return 0;
}
