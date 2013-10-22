Servis za provjeru slika
------------------------

Provjerava predstavljaju li poslani podaci validnu sliku, i je li slika podobna
za resizanje.

#### Protokol ####

Komunikacija ide 0MQom, koristeći Google Protobuf!

#### Model #####

```
package ImageInfo;

message DimenzijeSlike {
  required uint32 width = 1;
  required uint32 height = 2;
}

message Zahtjev {
  required uint32 velicinaSlike = 1;
  required bytes originalnaSlika = 2;
}

message Odgovor {
  required bool status = 1;
  required string poruka = 2;
  optional DimenzijeSlike dimenzije = 3;
}
```
