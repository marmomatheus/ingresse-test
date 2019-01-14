docker-compose up -d

docker exec -it ingresse-test-application composer install
docker exec -it ingresse-test-application php artisan migrate
docker exec -it ingresse-test-application php artisan passport:install