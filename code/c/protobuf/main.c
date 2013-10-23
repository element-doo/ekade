#include <stdio.h>
#include <stdlib.h>
#include "model/image.pb-c.h"

#define Zahtjev Com__Emajliramokade__Proto__Image__Proto__Zahtjev
#define ZAHTJEV_INIT COM__EMAJLIRAMOKADE__PROTO__IMAGE__PROTO__ZAHTJEV__INIT
#define zahtjev_get_packed_size com__emajliramokade__proto__image__proto__zahtjev__get_packed_size
#define zahtjev_pack com__emajliramokade__proto__image__proto__zahtjev__pack

int main (int argc, const char * argv[])
{
    Zahtjev msg = ZAHTJEV_INIT;

    if (argc != 3)
    {
        fprintf(stderr,"Need 2 arguments.\n");
        return 1;
    }

    FILE *infile = fopen(argv[1], "r");
    if (!infile)
    {
        fprintf(stderr, "File Not Found!\n");
        return 2;
    }

    FILE *outfile = fopen(argv[2], "wb");
    if (!outfile) {
        fprintf(stderr, "Can not write!\n");
        fclose(infile);
        return 3;
    }

    fseek(infile, 0, SEEK_END);
    int image_size = ftell(infile);
    fseek(infile, 0, SEEK_SET);

    unsigned char *image_buffer = (unsigned char *) malloc(image_size);

    if (!fread(image_buffer, image_size, 1, infile)) {
        fprintf(stderr, "File Not Found!\n");
        fclose(infile);
        fclose(outfile);
        free(image_buffer);
        return 4;   
    }

    fclose(infile);

    msg.originalnaslika.data = image_buffer;
    msg.originalnaslika.len = image_size;
    int message_size = zahtjev_get_packed_size(&msg);

    unsigned char *message_buffer = (unsigned char *) malloc(message_size);

    zahtjev_pack(&msg, message_buffer);

    fprintf(stderr, "Writing %d serialized bytes\n", message_size);

    fwrite(message_buffer, message_size, 1, outfile);
    fclose(outfile);

    free(message_buffer);
    free(image_buffer);

    return 0;
}