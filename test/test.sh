#!/bin/dash

# --- GO ---

b64=`base64 -w 0 wat.jpg`
uuid=`scala -e 'println(java.util.UUID.randomUUID)'`

curl -H 'Content-Type: application/json' -X POST \
  -d "{\"web\":\"$b64\"}" http://localhost:10080/crud/Kada/$uuid/Slike

curl -s http://localhost:10080/public/Slike/$uuid/Web > wat2.jpg

echo 'Go: Roundabout trip zavrsava bez puno buke (watovi su isti)'
cmp -l wat.jpg wat2.jpg
echo 

# --- RUST ---

echo 'Rust: Domena je OK ...'
../code/rust/kade_client tcp://127.0.0.1:10120 test.xxx

echo 'Rust: Domena je jadna ...'
../code/rust/kade_client tcp://127.0.0.1:10120 xxx.test
echo 

# --- PYTHON ---

echo 'Python: Email nebi smio valjati ...'
curl -H 'Content-Type: application/json' -X POST \
  -d '{"email":"marko@example.com"}' http://localhost:10060/api/v1/check/
echo 

echo 'Python: Email je zuper!'
curl -H 'Content-Type: application/json' -X POST \
  -d '{"email":"marko@element.hr"}' http://localhost:10060/api/v1/check/
echo 
echo 

# --- LARAVEL ---

echo 'PHP: Domena ne prima mailove ...'
curl -H 'Content-Type: application/json' -X POST \
  -d '{"email":"marko@example.com"}' http://localhost:10070/zahtjev-check
echo 

echo 'PHP: ma sve je OK!'
curl -H 'Content-Type: application/json' -X POST \
  -d '{"email":"marko@element.hr"}' http://localhost:10070/zahtjev-check
echo 
echo 
