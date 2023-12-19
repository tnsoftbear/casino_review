# Run "deploy" target commands with "www-data" user
# Examples:
# make remake user=manjaro
# make remake
ifeq ($(APP_BUILD_TARGET),deploy)
	cf = -f infra/docker/docker-compose-deploy.yml
	ifeq ($(user),)
		uf = -u www-data
#		ba = --build-arg user=www-data
	else
		uf = -u $(user)
#		ba = --build-arg user=$(user)
	endif
else
	cf = -f infra/docker/docker-compose-dev.yml
	ifeq ($(user),)
		uf =
	else
		uf = -u $(user)
#		ba = --build-arg user=$(user)
	endif
endif

install:
	@make build
	@make up
	docker compose $(cf) exec $(uf) app composer install
	docker compose $(cf) exec $(uf) app cp .env.example .env
	docker compose $(cf) exec $(uf) app php artisan key:generate
	docker compose $(cf) exec $(uf) app php artisan storage:link
	docker compose $(cf) exec $(uf) app chmod -R 777 storage bootstrap/cache
#	@make fresh
build:
#	docker compose $(cf) build
	docker compose $(cf) build --no-cache
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
fresh:
	docker compose $(cf) exec $(uf) app php artisan migrate:fresh --seed

# https://github.com/ucan-lab/docker-laravel/blob/main/Makefile