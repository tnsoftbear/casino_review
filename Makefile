# Run "deploy" target commands with "www-data" user
# Example for "deploy" target:
# APP_BUILD_TARGET=deploy make build
# Example for "dev" target:
# make build user=manjaro
# APP_BUILD_TARGET= make build
ifeq ($(APP_BUILD_TARGET),deploy)
	cf = -f infra/docker/docker-compose-deploy.yml
	uf = -u www-data
else
	cf = -f infra/docker/docker-compose-dev.yml
	uf =
endif

ifeq ($(nocache),1)
	nc = --no-cache
else
	nc =
endif

bau =
ifneq ($(user),)
	bau = --build-arg user=$(user)
endif

install:
	@make build
	@make up
	docker compose $(cf) exec $(uf) app composer install
	docker compose $(cf) exec $(uf) app cp .env.example .env
	docker compose $(cf) exec $(uf) app php artisan key:generate
	docker compose $(cf) exec $(uf) app php artisan storage:link
	docker compose $(cf) exec $(uf) app chmod -R 777 storage bootstrap/cache
	@make fresh
build:
	docker compose $(cf) build $(nc) $(bau)
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
fresh:
	docker compose $(cf) exec $(uf) app php artisan migrate:fresh --seed

# https://github.com/ucan-lab/docker-laravel/blob/main/Makefile