module Resursi
{
  root MaxDimenzije(ID) {
    String  ID; // "web", "email", "thumbnail"
    Int     width;
    Int     height;

    /*
    static original  'Original'  { create 'width = 4000, height = 4000'; }
    static web       'Web'       { create 'width = 1280, height =  960'; }
    static email     'Email'     { create 'width =  640, height =  640'; }
    static thumbnail 'Thumbnail' { create 'width =  200, height =  200'; }
    */
  }

  // Rucno popisane razlicite sve velicine kada potrebne za sustav
  // Velicine nisu striktno zadane, već su limitirane nekakvim maximalnim boxom

  mixin SlikeUseCases {
    Fingerprint  digest;
    PodaciSlike  original;  // uploadana slika
    PodaciSlike  web;       // za prikaz online
    PodaciSlike  email;     // za slanje emajlom
    PodaciSlike  thumbnail; // za galeriju
  }

  value Fingerprint {
    Binary  sha1Bytes;
    Binary? sha1Pixels;
  }

  root SlikeKade(ID) {
    Guid                ID;
    PopisKada.Kada(ID)  *kada;

    has mixin SlikeUseCases;

    persistence { optimistic concurrency; }
  }

  // Podaci potrebni za prikaz galerije, sam sadržaj se ralazi u nekom trećem storageu
  value PodaciSlike {
    String  ime;     // "rustikalna-kada" (derived slug name)
    String  format;  // "jpg" (uglavnom ce sve biti JPEG, no ...)
    Int     width;   // 1280 (px)
    Int     height;  // 670 (px)
    Int     size;    // 300203 (bytova)

    calculated String filename from 'it => it.ime + "-" + it.width + "x" + it.height + "." + it.format';
  }
}
