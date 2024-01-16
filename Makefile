# We "deploy" target commands with "www-data" user
# Example for "deploy" target:
# APP_BUILD_TARGET=deploy make build
#
# Example for "dev" target:
# make rebuild
# make remake user=manjaro nocache=1
# APP_BUILD_TARGET= make build
ifeq ($(APP_BUILD_TARGET),deploy)
	cf = -f infra/docker/docker-compose-deploy.yml
	uf = -u www-data
else
	cf = -f infra/docker/docker-compose-dev.yml
	uf =
endif

ncf =
ifeq ($(nocache),1)
	ncf = --no-cache
endif

ifeq ($(user),)
	user = $(shell whoami)
endif
bauser = --build-arg user=$(user)

ifeq ($(uid),)
	uid = $(shell id -u)
endif
bauid = --build-arg uid=$(uid)

install:
	@make build
	@make up
	docker compose $(cf) exec $(uf) app composer install
	docker compose $(cf) exec $(uf) app cp .env.example .env
	docker compose $(cf) exec $(uf) app chmod -R 777 storage bootstrap/cache
	docker compose $(cf) exec $(uf) app php artisan app:install
build:
	docker compose $(cf) build $(ncf) $(bauser) $(bauid)
rebuild:
	@make down
	@make build
	@make up
up:
	docker compose $(cf) up -d
stop:
	docker compose $(cf) stop
down:
	docker compose $(cf) down --remove-orphans
down-v:
	docker compose $(cf) down --remove-orphans --volumes
restart:
	@make down
	@make up
destroy:
	docker compose $(cf) down --rmi all --volumes --remove-orphans
remake:
	@make destroy
	@make install
ps:
	docker compose $(cf) ps
web:
	docker compose $(cf) exec $(uf) web bash
app:
	docker compose $(cf) exec $(uf) app bash
db:
	docker compose $(cf) exec $(uf) db bash
tinker:
	docker compose $(cf) exec $(uf) app php artisan tinker
dump:
	docker compose $(cf) exec $(uf) app php artisan dump-server
test:
	docker compose $(cf) exec $(uf) app php artisan test
migrate:
	docker compose $(cf) exec $(uf) app php artisan migrate

# https://github.com/ucan-lab/docker-laravel/blob/main/Makefile