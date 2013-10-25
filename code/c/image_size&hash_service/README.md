Skinuti Image Magick ako vec nije instaliran:

http://www.imagemagick.org/download/ImageMagick.tar.gz

./configure
make
sudo make install
sudo ldconfig


Probati identificirati neku sliku:
identify <ime.slike>

convert -list format     // podrzani formatis
convert -list configure  // redak delegates


Ako delegati nedostaju,
instalirati sa:
http://www.imagemagick.org/download/delegates/.

./configure
make
sudo make install
sudo ldconfig