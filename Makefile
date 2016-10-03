APP_NAME ?= alastor

COMPOSE_FILE_DEV := environment/docker-compose/development.yml

.PHONY: install start stop

install:
	npm i -g typescript typings
	npm i
	typings install
	cd src && composer install
	cd src && composer run-script post-root-package-install
	cd src && composer run-script post-create-project-cmd

start:
	docker-compose -f $(COMPOSE_FILE_DEV) -p $(APP_NAME) up -d webserver

stop:
	docker-compose -f $(COMPOSE_FILE_DEV) -p $(APP_NAME) ps -q | xargs docker stop --
