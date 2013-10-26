server {
  listen static.emajliramokade.com:80;
  server_name static.emajliramokade.com;
  
  access_log /var/www/ekade/logs/nginx/plain-access.log combined buffer=32k;
  error_log  /var/www/ekade/logs/nginx/plain-error.log;
  
  location ~ ^/email/[^/]+/.*\.jpe?g$ {
    rewrite ^/email/([^/]+)/.* /public/Slike/$1/Email break;
    proxy_pass http://127.0.0.1:6081;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }
  
  location ~ ^/thumbnail/[^/]+/.*\.jpe?g$ {
    rewrite ^/thumbnail/([^/]+)/.* /public/Slike/$1/Thumbnail break;
    proxy_pass http://127.0.0.1:6081;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }
  
  location ~ ^/web/[^/]+/.*\.jpe?g$ {
    rewrite ^/web/([^/]+)/.* /public/Slike/$1/Web break;
    proxy_pass http://127.0.0.1:6081;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }
}

server {
  listen emajliramokade.com:80;
  server_name .emajliramokade.com;
  
  access_log /var/www/ekade/logs/nginx/plain-access.log combined buffer=32k;
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
  resolver 8.8.8.8;
  ssl_verify_depth 1;
  ssl_stapling_verify on;
  ssl_trusted_certificate  /var/www/CAbundle.crt;

  keepalive_timeout         70;
  ssl_session_timeout       5m;
  ssl_protocols             TLSv1 TLSv1.1 TLSv1.2;
  ssl_ciphers               ECDHE-RSA-AES128-SHA256:AES128-GCM-SHA256:RC4:HIGH:!MD5:!aNULL:!EDH;
  ssl_prefer_server_ciphers on;
  ssl_session_cache         shared:SSL:10m;

  access_log /var/www/ekade/logs/nginx/static-access.log combined buffer=32k;
  error_log  /var/www/ekade/logs/nginx/static-error.log;
  
  location ~ ^/email/[^/]+/.*\.jpe?g$ {
    rewrite ^/email/([^/]+)/.* /public/Slike/$1/Email break;
    proxy_pass http://127.0.0.1:6081;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }
  
  location ~ ^/thumbnail/[^/]+/.*\.jpe?g$ {
    rewrite ^/thumbnail/([^/]+)/.* /public/Slike/$1/Thumbnail break;
    proxy_pass http://127.0.0.1:6081;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }
  
  location ~ ^/web/[^/]+/.*\.jpe?g$ {
    rewrite ^/web/([^/]+)/.* /public/Slike/$1/Web break;
    proxy_pass http://127.0.0.1:6081;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }
  
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

  client_max_body_size 10M;
  
  ssl_stapling on;
  resolver 8.8.8.8;
  ssl_verify_depth 1;
  ssl_stapling_verify on;
  ssl_trusted_certificate  /var/www/CAbundle.crt;

  keepalive_timeout         70;
  ssl_session_timeout       5m;
  ssl_protocols             TLSv1 TLSv1.1 TLSv1.2;
  ssl_ciphers               ECDHE-RSA-AES128-SHA256:AES128-GCM-SHA256:RC4:HIGH:!MD5:!aNULL:!EDH;
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

  location ~ ^/api { 
    proxy_pass http://10.5.17.1:10040;
    #proxy_pass http://127.0.0.1:10010;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }

  location ~ ^/platform/.* {
    rewrite ^/platform/(.*) /kade/$1 break;
    proxy_pass https://platform.emajliramokade.com;
    proxy_set_header Host platform.emajliramokade.com;
    #proxy_pass https://10.5.6.100;
    #proxy_set_header Host snowball.dsl-platform.com;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-Proto $scheme;
  }

  location ~ ^/upload {
    #proxy_pass http://10.5.6.1:65432;
    proxy_pass http://127.0.0.1:10050;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }

  location ~ ^/uploadPHP {
    #proxy_pass http://10.5.6.1:12345;
    proxy_pass http://127.0.0.1:10071;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }

  location ~ ^/neven/(.*) {
    rewrite ^/neven/(.*) /$1 break;
    proxy_pass http://10.5.3.1:12000;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }

  location ~ ^/robi/(.*) {
    rewrite ^/robi/(.*) /$1 break;
    proxy_pass http://10.5.6.7;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }

  location / {
    allow 10.0.0.0/8;
    allow 85.10.50.226;
    deny all;

    root /var/www/ekade/code/javascript/site/;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }

#  location / {
#    root /var/www/ekade/public;
#    deny all;
#    proxy_set_header REMOTE_ADDR $remote_addr;
#    proxy_set_header X-Real-IP $remote_addr;
#    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
#    proxy_set_header HOST $host;
#  }
}

server {
  listen api.emajliramokade.com:443 ssl spdy;
  server_name api.emajliramokade.com;

  ssl on;
  ssl_certificate     /etc/certs/emajliramokade.com.crt;
  ssl_certificate_key /etc/certs/emajliramokade.com.key;
  
  client_max_body_size 10M;
  
  ssl_stapling on;
  resolver 8.8.8.8;
  ssl_verify_depth 1;
  ssl_stapling_verify on;
  ssl_trusted_certificate  /var/www/CAbundle.crt;

  keepalive_timeout         70;
  ssl_session_timeout       5m;
  ssl_protocols             TLSv1 TLSv1.1 TLSv1.2;
  ssl_ciphers               ECDHE-RSA-AES128-SHA256:AES128-GCM-SHA256:RC4:HIGH:!MD5:!aNULL:!EDH;
  ssl_prefer_server_ciphers on;
  ssl_session_cache         shared:SSL:10m;

  location /feed.xml {
    rewrite ^ /apex/NOVINE.TEST_FEED break;
    proxy_pass http://127.0.0.1:8080;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }
  
  location ~ ^/feed.js(on)?$ {
    rewrite ^ /apex/novine/novosti/vijesti break;
    proxy_pass http://127.0.0.1:8080;
    proxy_set_header REMOTE_ADDR $remote_addr;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header HOST $host;
  }
}

server {
  listen admin.emajliramokade.com:443 ssl spdy;
  server_name admin.emajliramokade.com;

  ssl on;
  ssl_certificate     /etc/certs/emajliramokade.com.crt;
  ssl_certificate_key /etc/certs/emajliramokade.com.key;
  
  client_max_body_size 10M;
  
  ssl_stapling on;
  resolver 8.8.8.8;
  ssl_verify_depth 1;
  ssl_stapling_verify on;
  ssl_trusted_certificate  /var/www/CAbundle.crt;

  keepalive_timeout         70;
  ssl_session_timeout       5m;
  ssl_protocols             TLSv1 TLSv1.1 TLSv1.2;
  ssl_ciphers               ECDHE-RSA-AES128-SHA256:AES128-GCM-SHA256:RC4:HIGH:!MD5:!aNULL:!EDH;
  ssl_prefer_server_ciphers on;
  ssl_session_cache         shared:SSL:10m;

  access_log /var/www/ekade/logs/nginx/admin-access.log combined buffer=32k;
  error_log  /var/www/ekade/logs/nginx/admin-error.log;

  location ~ ^/platform/.* {
    rewrite ^/platform/(.*) /kade/$1 break;
    proxy_pass https://platform.emajliramokade.com;
    proxy_set_header Host platform.emajliramokade.com;
    #proxy_pass https://10.5.6.100;
    #proxy_set_header Host snowball.dsl-platform.com;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-Proto $scheme;
  }
  
  location / {
    auth_basic            "Restricted";
    auth_basic_user_file  htpasswd;

    rewrite ^/$ /admin.html break;
    root /var/www/ekade/design/html;

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
  resolver 8.8.8.8;
  ssl_verify_depth 1;
  ssl_stapling_verify on;
  ssl_trusted_certificate  /var/www/CAbundle.crt;

  keepalive_timeout         70;
  ssl_session_timeout       5m;
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
  listen secure.emajliramokade.com:443 ssl spdy;
  server_name secure.emajliramokade.com;

  ssl on;
  ssl_certificate     /etc/certs/wc.emajliramokade.com.crt;
  ssl_certificate_key /etc/certs/wc.emajliramokade.com.key;
    
  ssl_stapling on;
  resolver 8.8.8.8;
  ssl_verify_depth 1;
  ssl_stapling_verify on;
  ssl_trusted_certificate  /var/www/CAbundle.crt;

  keepalive_timeout         70;
  ssl_session_timeout       5m;
  ssl_protocols             TLSv1 TLSv1.1 TLSv1.2;
  ssl_ciphers               ECDHE-RSA-AES128-SHA256:AES128-GCM-SHA256:RC4:HIGH:!MD5:!aNULL:!EDH;
  ssl_prefer_server_ciphers on;
  ssl_session_cache         shared:SSL:10m;

  access_log /var/www/ekade/logs/nginx/wc-access.log combined buffer=32k;
  error_log  /var/www/ekade/logs/nginx/wc-error.log;
  
  location ~ ^/odjava/.* {
    rewrite ^/odjava/(.*)$ /apex/novine/odjave/odjave/$1 break;
    proxy_pass http://127.0.0.1:8080;
	proxy_method PUT;
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
  resolver 8.8.8.8;
  ssl_verify_depth 1;
  ssl_stapling_verify on;
  ssl_trusted_certificate  /var/www/CAbundle.crt;

  keepalive_timeout         70;
  ssl_session_timeout       5m;
  ssl_protocols             TLSv1 TLSv1.1 TLSv1.2;
  ssl_ciphers               ECDHE-RSA-AES128-SHA256:AES128-GCM-SHA256:RC4:HIGH:!MD5:!aNULL:!EDH;
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
