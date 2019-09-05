docker-up: memory
	docker-compose up -d

docker-down:
	docker-compose down

docker-build: memory
	docker-compose up --build -d

test:
	docker-compose exec laravel_php vendor/bin/phpunit

queue:
	docker-compose exec laravel_php php artisan queue:work

horizon:
	docker-compose exec laravel_php php artisan horizon

horizon-pause:
	docker-compose exec laravel_php php artisan horizon:pause

horizon-continue:
	docker-compose exec laravel_php php artisan horizon:continue

horizon-terminate:
	docker-compose exec laravel_php php artisan horizon:terminate

memory:
	sudo sysctl -w vm.max_map_count=262144

perm:
	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache

clear:
	php artisan route:clear
	php artisan config:clear
	php artisan cache:clear
	composer dump-autoload

up:
	docker-compose up -d

stop:
	docker-compose stop