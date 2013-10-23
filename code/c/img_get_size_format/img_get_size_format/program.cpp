#include <stdio.h>
//#include <unistd.h>
#include <string.h>
#include <stdlib.h>
#include <assert.h>
#include <wand/MagickWand.h>
#include <zmq.h>


int main (int argc,char **argv)
 {
	FILE *fp;
	unsigned char *polje;
	char format[5];
	int len, i;
	size_t width, height;

	MagickWand	*image_wand;
	MagickBooleanType status;


	//ucitavanje slike
	if( (fp = fopen(argv[1],"rb")) == NULL)
		printf("nemoze otvorit sliku\n");

	fseek(fp,0,SEEK_END);
	len = ftell(fp);
	fseek(fp,0,SEEK_SET);

	polje = (unsigned char*) malloc (len);
	fread(polje,1,len,fp);

	//ucitavanje u imagemagick

	MagickWandGenesis();
	image_wand = NewMagickWand();

	status = MagickReadImageBlob(image_wand, polje, len);
	
	//status = MagickReadImage(image_wand,argv[1]);
	
	free(polje);
	if (status == MagickFalse)
					{printf("\nnevalja status\n"); exit(-1);}

	for(i = 0; i < 5; i++)
		format[i] = '\0';

	strcpy(format,MagickGetFormat(image_wand));
	MagickGetSize(image_wand, &width, &height);

	puts(MagickGetFormat(image_wand));
	printf("Format is %s\n", MagickGetFormat(image_wand));
	printf("Resolution is %dx%d\n", width, height);

	fclose(fp);

	//MagickWriteImage(image_wand,"avatar2.jpg");




	image_wand = DestroyMagickWand(image_wand); 
	MagickWandTerminus();

	system("pause");
     return 0;
 }
