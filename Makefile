lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes tests resources/lang database

test:
	php artisan test

database-prepare:
	cp -n .env.example .env || true
	php artisan key:generate --env=testing
	php -r "file_exists('.env') || copy('.env.testing.1', '.env');"
	touch database/database.sqlite
	php artisan migrate:fresh --force --seed

start-app:
	php artisan serve --host=0.0.0.0 --port=$(PORT)

install:
	composer install

install-npm:
	npm ci

validate:
	composer validate

refresh:
	php artisan migrate:refresh --seed

restart:
	sudo service postgresql restart

migrate:
	php artisan migrate:fresh --force --seed

seed:
	php artisan db:seed

npm:
	npm run dev

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

stan:
	vendor/bin/phpstan analyse app tests

start:
	php artisan migrate:fresh --force --seed
	php artisan serve --host=0.0.0.0 --port=$(PORT)