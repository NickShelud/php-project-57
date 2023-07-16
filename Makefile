setup: env-prepare postgresql-prepare install key db-prepare ide-helper
	npm run build

env-prepare:
	cp -n .env.example .env || true

postgresql-prepare:
	touch database/database.postgresql

install: install-app install-frontend

install-app:
	composer install

install-frontend:
	npm ci

key:
	php artisan key:generate

db-prepare:
	php artisan migrate:fresh --force --seed

ide-helper:
	php artisan ide-helper:eloquent
	php artisan ide-helper:gen
	php artisan ide-helper:meta
	php artisan ide-helper:mod -n

start: db-prepare start-app

start-app:
	php artisan serve --host=0.0.0.0 --port=$(PORT)

validate:
	composer validate

lint:
	composer exec phpcs -- --standard=PSR12 app routes tests

lint-fix:
	composer exec phpcbf -- --standard=PSR12 app routes tests

test:
	php artisan test

test-coverage:
	php artisan test --coverage-clover build/logs/clover.xml