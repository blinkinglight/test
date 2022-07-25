# test 

1. clone repo 

2. run: `docker run --rm -it -v $(pwd):/var/www --workdir /var/www spiksius/php8.1-apache composer install`

3. copy .env.prod-example to .env

4. run `docker-compose up -d` wait 1 minute, and check http://ip (ip or localhost)


to destroy container:

1. docker-compose down --remove-orphans -v
