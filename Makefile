APP_NAME ?= alastor

COMPOSE_FILE_DEV := environment/docker-compose/development.yml

.PHONY: start

start:
	docker-compose -f $(COMPOSE_FILE_DEV) -p $(APP_NAME) up -d webserver