Servis za provjeru emajla
=========================

Instalacija
-----------
Potreban je rust 0.8 i ~2 GB RAMa. Ovo treba pokrenuti iz istog direktorija u kojem se nalazi ovaj README.md:
    # Skidanje i buildanje rust compilera. Bitno je da je verzija 0.8.
    wget http://static.rust-lang.org/dist/rust-0.8.tar.gz
    tar -xzf rust-0.8.tar.gz
    cd rust-0.8
    ./configure
    make
    # Gradnja kade
    cd ..
    make

Pokretanje servera (prvi parametar je zmq adresa):
    ./kade_server tcp://*:5555

Pokretanje test klijenta (prvi parametar je zmq adresa, drugi je domena):
    ./kade_client tcp://127.0.0.1:5555 gmail.com

Protokol
--------
Server prima niz znakova koji predstavljaju utf-8 string (domenu). Niz znakova nije null-terminiran.

Odgovara s YES (postoji MX ili CNAME), NO (ne postoji) ili ERR (dogodila se greska).
