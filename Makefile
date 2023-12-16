cf = -f infra/docker/docker-compose.yml

install:
	@make build
	@make up
#	docker compose $(cf) exec app composer install
	docker compose $(cf) exec app cp .env.example .env
	docker compose $(cf) exec app php artisan key:generate
	docker compose $(cf) exec app php artisan storage:link
	docker compose $(cf) exec app chmod -R 777 storage bootstrap/cache
#	@make fresh
build:
	docker compose $(cf) build
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
	docker compose $(cf) exec web bash
app:
	docker compose $(cf) exec app bash
db:
	docker compose $(cf) exec db bash
#fresh:
#	docker compose $(cf) exec app php artisan migrate:fresh --seed

# https://github.com/ucan-lab/docker-laravel/blob/main/Makefile