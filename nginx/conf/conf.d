server {
    listen 80;
    listen [::]:80;

    server_name command-hub.si www.command-hub.si;
    server_tokens off;

    location /.well-known/acme-challenge/ {
        root /var/www/certbot;
    }

    location / {
        return 301 https://command-hub.si$request_uri;
    }
}

server {
    listen 443 default_server ssl http2;
    listen [::]:443 ssl http2;

    server_name command-hub.si;

    ssl_certificate /etc/nginx/ssl/live/command-hub.si/fullchain.pem;
    ssl_certificate_key /etc/nginx/ssl/live/command-hub.si/privkey.pem;

    location / {
    	# ...
    }
}
