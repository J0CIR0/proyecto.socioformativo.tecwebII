install:
	composer install
serve:
	php -S 0.0.0.0:8765 -t webroot/
migrate:
	bin/cake migrations migrate
test:
	phpunit
