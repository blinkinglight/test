# Test 


requirements: 
    docker community edition atleast 20.10.16
    bash or replace $(pwd) to full path of project.

1. clone repo 

2. cd test

3. run: `docker run --rm -it -v $(pwd):/var/www --workdir /var/www spiksius/php8.1-apache composer install`

4. copy .env.prod-example to .env

5. run `docker-compose up -d` wait 1 minute, and check filter: http://ip/api/cars?filter=2022-07-31 (ip or localhost)


to destroy container:

1. docker-compose down --remove-orphans -v
