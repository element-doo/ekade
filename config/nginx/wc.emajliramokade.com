server {
  listen emajliramokade.com:80;
  server_name .emajliramokade.com;
  
  access_log /var/www/ekade/logs/nginx/plain-access.log;
  error_log  /var/www/ekade/logs/nginx/plain-error.log;

  location / {
    rewrite ^(.*) https://$host$1 permanent;
  }
}

server {
  listen static.emajliramokade.com:443 ssl spdy;
  server_name static.emajliramokade.com;

  ssl on;
  ssl_certificate     /etc/certs/emajliramokade.com.crt;
  ssl_certificate_key /etc/certs/emajliramokade.com.key;
  
  ssl_stapling on;
  resolver 127.0.0.1;
  ssl_verify_depth 2;
  ssl_stapling_verify on;
  ssl_trusted_certificate  /var/www/CAbundle.crt;

  keepalive_timeout         70;
  ssl_session_timeout       5m;
  ssl_protocols             SSLv3 TLSv1;
  ssl_ciphers               ALL:!ADH:!EXPORT:!SSLv2:RC4+RSA:+HIGH:+MEDIUM;
  ssl_prefer_server_ciphers on;
  ssl_session_cache         shared:SSL:10m;

  access_log /var/www/ekade/logs/nginx/static-access.log combined buffer=32k;
  error_log  /var/www/ekade/logs/nginx/static-error.log;
  
  location ~ ^/kade/.* {
    root /var/www/ekade;
    expires 30d;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }  
}

server {
  listen emajliramokade.com:443 ssl spdy;
  server_name .emajliramokade.com;

  ssl on;
  ssl_certificate     /etc/certs/emajliramokade.com.crt;
  ssl_certificate_key /etc/certs/emajliramokade.com.key;

  ssl_stapling on;
  resolver 127.0.0.1;
  ssl_verify_depth 2;
  ssl_stapling_verify on;
  ssl_trusted_certificate  /var/www/CAbundle.crt;

  keepalive_timeout         70;
  ssl_session_timeout       5m;
  ssl_protocols             SSLv3 TLSv1;
  ssl_ciphers               ALL:!ADH:!EXPORT:!SSLv2:RC4+RSA:+HIGH:+MEDIUM;
  ssl_prefer_server_ciphers on;
  ssl_session_cache         shared:SSL:10m;

  access_log /var/www/ekade/logs/nginx/wc-access.log combined buffer=32k;
  error_log  /var/www/ekade/logs/nginx/wc-error.log;
  
  location ~ ^/api/v1/.* {
    proxy_pass http://127.0.0.1:10060;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }  

  location ~ ^/platform/.* {
    rewrite ^/platform/(.*) /kade/$1 break;
    #proxy_pass https://platform.emajliramokade.com;
    #proxy_set_header Host platform.emajliramokade.com;
    proxy_pass https://10.5.6.100;
    proxy_set_header Host snowball.dsl-platform.com;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-Proto $scheme;
  }

  location /dev {
    rewrite ^/dev/(.*) /$1 break;
    proxy_pass http://10.5.6.7;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }

  location / {
    root /var/www/ekade/public;
#    deny all;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }
}

server {
  listen ivica.emajliramokade.com:443 ssl spdy;
  server_name ivica.emajliramokade.com;

  ssl on;
  ssl_certificate     /etc/certs/wc.emajliramokade.com.crt-test;
  ssl_certificate_key /etc/certs/wc.emajliramokade.com.key;

  ssl_stapling on;
  resolver 127.0.0.1;
  ssl_verify_depth 2;
  ssl_stapling_verify on;
  ssl_trusted_certificate  /var/www/CAbundle.crt;

  keepalive_timeout         70;
  ssl_session_timeout       5m;
#  ssl_protocols             SSLv3 TLSv1;
#  ssl_ciphers               ALL:!ADH:!EXPORT:!SSLv2:RC4+RSA:+HIGH:+MEDIUM;
 # ssl_protocols       SSLv3 TLSv1 TLSv1.1 TLSv1.2;
 # ssl_ciphers         HIGH:!aNULL:!MD5;
 
#  ssl_protocols             TLSv1 TLSv1.1 TLSv1.2;
#  ssl_ciphers               AES256-SHA256:AES256-SHA;
 
  ssl_protocols             TLSv1 TLSv1.1 TLSv1.2;
  ssl_ciphers               ECDHE-RSA-AES128-SHA256:AES128-GCM-SHA256:RC4:HIGH:!MD5:!aNULL:!EDH; 
  ssl_prefer_server_ciphers on;
  ssl_session_cache         shared:SSL:10m;

  access_log /var/www/ekade/logs/nginx/wc-access.log combined buffer=32k;
  error_log  /var/www/ekade/logs/nginx/wc-error.log;

  location / {
    proxy_pass http://10.5.16.1:10070;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }
}

server {
  listen wc.emajliramokade.com:443 ssl spdy;
  server_name .emajliramokade.com;

  ssl on;
  ssl_certificate     /etc/certs/wc.emajliramokade.com.crt;
  ssl_certificate_key /etc/certs/wc.emajliramokade.com.key;

  ssl_stapling on;
  resolver 127.0.0.1;
  ssl_verify_depth 1;
  ssl_stapling_verify on;
  ssl_trusted_certificate  /var/www/CAbundle.crt;

  keepalive_timeout         70;
  ssl_session_timeout       5m;
  ssl_protocols             SSLv3 TLSv1;
  ssl_ciphers               ALL:!ADH:!EXPORT:!SSLv2:RC4+RSA:+HIGH:+MEDIUM;
  ssl_prefer_server_ciphers on;
  ssl_session_cache         shared:SSL:10m;

  access_log /var/www/ekade/logs/nginx/wc-access.log combined buffer=32k;
  error_log  /var/www/ekade/logs/nginx/wc-error.log;

  location / {
    deny all;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }
}
