lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes tests resources/lang database

test:
	php artisan test

start-app:
	php artisan serve --host=0.0.0.0 --port=$(PORT)

install:
	composer install

validate:
	composer validate

refresh:
	php artisan migrate:refresh --seed

restart:
	sudo service postgresql restart

migrate:
	php artisan migrate

seed:
	php artisan db:seed

npm:
	npm run dev

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

stan:
	vendor/bin/phpstan analyse app tests 