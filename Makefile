check: lint analyze test
lint: api-lint
analyze: api-analyze
test: api-test

php-cli:
	docker-compose run --rm api-php-cli php cli.php ${args}

api-test:
	docker-compose run --rm api-php-cli composer test

api-test-unit:
	docker-compose run --rm api-php-cli composer test -- --testsuite=unit

api-test-functional:
	docker-compose run --rm api-php-cli composer test -- --testsuite=functional

api-lint:
	docker-compose run --rm api-php-cli composer lint
	docker-compose run --rm api-php-cli composer cs-check

api-analyze:
	docker-compose run --rm api-php-cli composer psalm

init:
	docker-compose up -d

cmd:
	docker-compose run --rm api-php-cli ${cmd}

console:
	docker-compose run --rm api-php-cli php bin/app.php ${args}

composer-cmd:
	docker-compose run --rm api-php-cli composer ${arg}

phinx:
	docker-compose run --rm api-php-cli vendor/bin/phinx ${arg}

phpunit:
	docker-compose run --rm api-php-cli vendor/bin/phpunit ${arg}

doctrine:
	docker-compose run --rm api-php-cli vendor/bin/doctrine ${arg}

images-rm:
	docker system prune -af
