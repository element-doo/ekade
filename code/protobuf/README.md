Instalacija protobufa 2.5: https://protobuf.googlecode.com/files/protobuf-2.5.0.tar.gz

cd protobuf

./configure

make

sudo make install 

sudo ldconfig

//-----------------------------
shvatiti da treba protobuf-c

http://protobuf-c.googlecode.com/files/protobuf-c-0.15.tar.gz

configure

make

sudo make install

sudo ldconfig

protoc-c  --c_out=./gen ./model/image.proto

Za development (iz ../c/protobuf/):
clang -g -Wall -I../../protobuf/c main.c ../../protobuf/c/model/image.pb-c.c -lprotobuf-c -o protobufferer

Za produkciju
gcc -Wall -O2 -I../../protobuf/c main.c ../../protobuf/c/model/image.pb-c.c -lprotobuf-c -o protobufferer