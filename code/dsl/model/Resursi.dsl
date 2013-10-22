module Resursi
{
  // Rucno popisane razlicite sve velicine kada potrebne za sustav
  // Velicine nisu striktno zadane, već su limitirane nekakvim maximalnim boxom
  root SlikeKade(ID) {
    Guid                ID;
    PopisKada.Kada(ID)  *kada;

    PodaciSlike  original;  // uploadana slika
    PodaciSlike  web;       // max: 1280x800
    PodaciSlike  email;     // max: 640x400
    PodaciSlike  thumbnail; // max: 200x120

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
