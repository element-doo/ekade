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
	char format[5] = {0};
	int len;
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
	
	free(polje);
	if (status == MagickFalse)
					{printf("\nnevalja status\n"); exit(-1);}

	strcpy(format,MagickGetImageFormat(image_wand));
	width = MagickGetImageWidth(image_wand);
	height = MagickGetImageHeight(image_wand);

	printf("width = %d\nheight = %d\nformat = %s\n",width,height,format);

	fclose(fp);

	image_wand = DestroyMagickWand(image_wand); 
	MagickWandTerminus();

	system("pause");
    return 0;
 }
