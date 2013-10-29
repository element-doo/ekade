Services:
1) Objava novih vijesti
http://emajliramokade.com:8080/apex/novine/novosti/objavi
POST
NASLOV, TEKST (u headeru)

2) Dohvat svih vijesti (JSON)
http://emajliramokade.com:8080/apex/novine/novosti/vijesti
GET

3) Provjera emaila - vraca HASH emaila, zapisuje hash u tablicu. Ukoliko je mail odjavljen vraca prazno.
http://emajliramokade.com:8080/apex/novine/odjave/check/{EMAIL}
GET
EMAIL - email adresa

4) Odjava emaila
http://emajliramokade.com:8080/apex/novine/odjave/odjave/{INHASH}
PUT 
INHASH je hash emaila (onaj od gore, tako da se moze link konstruirati lagano)

5) RSS svih vijesti:
http://emajliramokade.com:8080/apex/NOVINE.TEST_FEED
GET

// PUBLIC API ZA VIJESTI je KONSOLIDIRAN U NGINXU (SVE GETOVI):

2) Dohvat svih vijesti (JSON)
https://api.emajliramokade.com/feed.json

RSS svih vijesti:
https://api.emajliramokade.com/feed.xml

// PUBLIC API ZA ODJAVU je REWRITEAN U GET:

4) Odjava emaila
https://secure.emajliramokade.com/odjava/{INHASH}
