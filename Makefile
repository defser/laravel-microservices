# HELP
# This will output the help for each task
# thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help build

ifndef container
    override container = microservice_api
endif

ifndef package
    override package = ''
endif

help:
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help

.ONESHELL:
# Build the container
build: ## Build the container
	if [ ! -f docker/.env ]; then cp docker/.env.example docker/.env; fi
	cd docker; docker-compose build --no-cache
	cd docker; docker-compose up -d --force-recreate

# Build and run the container
up: ## Spin up the project
	cd docker; docker-compose up -d --force-recreate

stop: ## Stop running containers
	cd docker; docker-compose stop

rm: stop ## Stop and remove running containers
	cd docker; docker-compose down --rmi all

login: ## Login to a container of the project
	docker exec -it -u www-data $(container) bash

composer_install: ## Run composer install on containers
	docker exec -it -u www-data docker_api_1 composer install
	docker exec -it -u www-data docker_inventory_1 composer install
	docker exec -it -u www-data docker_order_1 composer install
	docker exec -it -u www-data docker_user_1 composer install

composer_update: ## Run composer update on containers
	docker exec -it -u www-data docker_api_1 composer update
	docker exec -it -u www-data docker_inventory_1 composer update
	docker exec -it -u www-data docker_order_1 composer update
	docker exec -it -u www-data docker_user_1 composer update

composer_require: ## Run composer require on containers
	docker exec -it -u www-data docker_api_1 composer require $(package)
	docker exec -it -u www-data docker_inventory_1 composer require $(package)
	docker exec -it -u www-data docker_order_1 composer require $(package)
	docker exec -it -u www-data docker_user_1 composer require $(package)