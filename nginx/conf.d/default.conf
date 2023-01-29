server {
    listen 80 default_server;
    server_name _;
    root /app/public;
    index index.php;
    charset utf-8;

    location = /favicon.ico { log_not_found off; access_log off; }
    location = /robots.txt  { log_not_found off; access_log off; }

    client_max_body_size 25M;

    error_page 404 /index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;

        add_header X-Served-By kool.dev;
    }

    location ~ \.php$ {
        fastcgi_buffers 8 8k;
        fastcgi_buffer_size 16k;
        fastcgi_pass unix:/run/php-fpm.sock;
        fastcgi_read_timeout 60s;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }

    # good practices
    add_header X-Frame-Options "SAMEORIGIN";

    # basic H5BP suggestions
    include h5bp/internet_explorer/x-ua-compatible.conf;
    include h5bp/security/referrer-policy.conf;
    include h5bp/security/x-content-type-options.conf;
    include h5bp/security/x-xss-protection.conf;

    # performance enhancements (mostly for caching static data)
    include h5bp/web_performance/cache-file-descriptors.conf;
    include h5bp/web_performance/pre-compressed_content_gzip.conf;
}
