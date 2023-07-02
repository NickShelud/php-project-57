lint:
	composer exec --verbose phpcs -- --standard=PSR12 app/Http/Controllers routes tests

test:
	php artisan test

start:
	php artisan serve

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