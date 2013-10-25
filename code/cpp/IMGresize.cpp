#define cimg_display 0

#define PIC "pic."
#define PIC_RES "picresize."
#define PORT 10020

#include <iostream>
#include <fstream>
#include <sstream>
#include "CImg.h"
#include "base64.h"
#include <jsonrpc/rpc.h>
#include "abstractimgserver.h"

using namespace jsonrpc;
using namespace std;
using namespace Json;

class IMGServer : public AbstractIMGServer{
public:
	IMGServer();
        virtual Value resize(const string& width, const string& format, const string& height, const string& maxWidth, const string& maxHeight, const string& body);
};

IMGServer::IMGServer():AbstractIMGServer(new HttpServer(PORT)){
}

Value IMGServer::resize(const string& body, const string& format, const string& height, const string& maxHeight, const string& maxWidth, const string& width){
	string picFilename(PIC);
	picFilename+=format;
	string picResizeFilename(PIC_RES);
	picResizeFilename+=format;

	fstream pic(picFilename.c_str(), ofstream::binary | ofstream::out);
	vector<BYTE> decode = base64_decode(body);

	for(int i=0; i<decode.size(); ++i) pic.write((const char*)&decode[i], 1);
	pic.close();

	Value ret;

	cimg_library::CImg<float> img(picFilename.c_str());
	if(img.width()>atoi(maxWidth.c_str()) || img.height()>atoi(maxHeight.c_str())){
		ret["error"]="400";
		stringstream error;
		error<<"Slika je veličine: "<<img.width()<<" x "<<img.height()<<", a maksimalno podržano je: "<<maxWidth<<" x "<<maxHeight<<".";
		ret["errorMsg"]=error.str();
		return ret;
	}
	img.resize(atoi(width.c_str()), atoi(height.c_str()));
	img.save(picResizeFilename.c_str());

	vector<BYTE> raw;
	pic.open(picResizeFilename.c_str(), ofstream::binary | ofstream::in);
	char buffer;
	for(pic.read(&buffer, 1); !pic.eof(); raw.push_back(buffer), pic.read(&buffer, 1));
	pic.close();
	string encode = base64_encode(&raw[0], raw.size());
	
	ret["resizedBody"]=encode.c_str();

	return ret;
}

int main()
{
    IMGServer s;
    s.StartListening();
    getchar();
    s.StopListening();
    return 0;
}
