FROM composer:latest

WORKDIR /var/www/timetracker

ENTRYPOINT ["composer", "--ignore-platform-reqs"]