lint:
	composer exec --verbose phpcs -- --standard=PSR12 app/Http/Controllers

test:
	php artisan test

start:
	php artisan serve

install:
	composer install --ignore-platform-reqs

validate:
	composer validate

refresh:
	php artisan migrate:refresh --seed