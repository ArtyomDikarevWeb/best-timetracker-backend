DOCKER_COMPOSE = docker compose -f docker-compose.yaml
DOCKER_RUN = docker compose run

all:
	@echo "Docker: "
	@echo " - make up"
	@echo " - make build"
	@echo " - male down"
	@echo " - make run"
	@echo " - make restart"
	@echo "Composer: "
	@echo " - make composer/install"
	@echo " - make composer/require"
	@echo " - make composer/require-dev"
	@echo " - make composer/dump-autoload"
	@echo " - make composer/remove"
	@echo "Artisan: "
	@echo " - make artisan/make"
	@echo " - make artisan/key-generate"
	@echo " - make artisan/migrate"
	@echo " - make artisan/seed"
	@echo " - make artisan/migrate-refresh"
	@echo " - make artisan/scribe-generate"

composer/install:
	${DOCKER_RUN} composer install

composer/require:
	${DOCKER_RUN} composer require $(REQ)

composer/require-dev:
	${DOCKER_RUN} composer require --dev $(REQ)

composer/dump-autoload:
	${DOCKER_RUN} composer dump-autoload

composer/remove:
	${DOCKER_RUN} composer remove $(REM)

composer/update:
	${DOCKER_RUN} composer update $(UPD)

artisan/make:
	${DOCKER_RUN} artisan make:$(ENT) $(NAME) $(FLAGS)

artisan/key-generate:
	${DOCKER_RUN} artisan key:generate

artisan/migrate:
	${DOCKER_RUN} artisan migrate

artisan/seed:
	${DOCKER_RUN} artisan db:seed

artisan/migrate-refresh:
	${DOCKER_RUN} artisan migrate:refresh

artisan/route-list:
	${DOCKER_RUN} artisan route:list

artisan/vendor/publish:
	${DOCKER_RUN} artisan vendor:publish $(PARAM)

artisan/generate-jwt:
	${DOCKER_RUN} artisan jwt:secret

artisan/config-clear:
	${DOCKER_RUN} artisan config:clear

artisan/cache-clear:
	${DOCKER_RUN} artisan cache:clear

artisan/scribe-generate:
	${DOCKER_RUN} artisan scribe:generate

artisan/run-list: artisan/key-generate artisan/generate-jwt artisan/migrate artisan/seed artisan/scribe-generate

run: build up composer/install artisan/run-list

build:
	${DOCKER_COMPOSE} build

up:
	${DOCKER_COMPOSE} up -d

down:
	${DOCKER_COMPOSE} down

restart:
	${DOCKER_COMPOSE} restart
