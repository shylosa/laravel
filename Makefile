#!/usr/bin/make

SHELL := /bin/sh
CURRENT_UID := $(shell id -u)
CURRENT_DIR := $(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))

#test:
#	@echo $(CURRENT_UID)

#remove folder with request cache
flush:
	php artisan route:clear
	php artisan config:clear
	php artisan cache:clear

#change owner and permissions for project folder
owner:
	sudo chown -R $(CURRENT_UID):www-data $(CURRENT_DIR)
	sudo chmod -R 775 $(CURRENT_DIR)

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

up:
	sudo service mysql stop
	sudo service apache2 stop
	sudo service nginx stop
	docker-compose up -d

stop:
	docker-compose stop

watch:
	npm run watch-poll