gcc -g -Wall -I/usr/local/include/ImageMagick-6/ -I../../protobuf/c image_size\&hash_service.c -std=c99 ../../protobuf/c/model/ImageProvjera.pb-c.c -lzmq -lprotobuf-c -lssl -lcrypto -lMagickWand-6.Q16 -o service -DMAGICKCORE_QUANTUM_DEPTH=16 -DMAGICKCORE_HDRI_ENABLE=0
./service "$@"

