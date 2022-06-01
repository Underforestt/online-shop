build:
	cd docker; \
	docker-compose build

up:
	cd docker; \
	docker-compose up -d; \
	docker-compose exec app composer install; \
    docker-compose exec app php artisan migrate:refresh; \
    docker-compose exec app php artisan cache:clear; \
    docker-compose exec app php artisan view:clear; \
    docker-compose exec app php artisan config:clear; \

down:
	cd docker; \
	docker-compose stop

restart:
	cd docker; \
	docker-compose restart

