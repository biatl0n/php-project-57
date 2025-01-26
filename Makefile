start:
	php artisan serve --host 0.0.0.0

start-frontend:
	npm run dev

test:
	php artisan test

install:
	composer install
	cp -n .env.example .env
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed
	npm install
	npm run build
	make ide-helper

ide-helper:
	php artisan ide-helper:eloquent
	php artisan ide-helper:gen
	php artisan ide-helper:meta
	php artisan ide-helper:mod -n

test-coverage:
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/logs/clover.xml

lint:
	composer exec phpcs

console:
	php artisan tinker

migrate:
	php artisan migrate

migrate-fresh-seed:
	php artisan migrate:fresh --seed