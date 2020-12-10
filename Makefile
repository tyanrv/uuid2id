check: lint analyze test
lint: api-lint
analyze: api-analyze
test: api-test
test-coverage: api-test-coverage
test-unit: api-test-unit
test-unit-coverage: api-test-unit-coverage
test-functional: api-test-functional
test-functional-coverage: api-test-functional-coverage
app-init: init api-init

php-cli:
	docker-compose run --rm api-php-cli php cli.php ${args}

api-init: api-composer-install api-wait-db api-migrations api-fixtures

api-permissions:
	docker-compose run --rm -v ${PWD}/api:/app -w /app alpine chmod 777 var/cache var/log

api-composer-install:
	docker-compose run --rm api-php-cli composer install

api-test:
	docker-compose run --rm api-php-cli composer test

api-test-coverage:
	docker-compose run --rm api-php-cli composer test-coverage

api-test-unit:
	docker-compose run --rm api-php-cli composer test -- --testsuite=unit

api-test-unit-coverage:
	docker-compose run --rm api-php-cli composer test-coverage -- --testsuite=unit

api-test-functional:
	docker-compose run --rm api-php-cli composer test -- --testsuite=functional

api-test-functional-coverage:
	docker-compose run --rm api-php-cli composer test-coverage -- --testsuite=functional

api-lint:
	docker-compose run --rm api-php-cli composer lint
	docker-compose run --rm api-php-cli composer cs-check

api-analyze:
	docker-compose run --rm api-php-cli composer psalm

api-wait-db:
	docker-compose run --rm api-php-cli wait-for-it api-postgres:5432 -t 30

api-migrations:
	docker-compose run --rm api-php-cli php bin/app.php migrations:migrate

api-fixtures:
	docker-compose run --rm api-php-cli php bin/app.php fixtures:load

init:
	docker-compose up -d

api-clear:
	docker run --rm -v ${PWD}/api:/app -w /app alpine sh -c 'rm -rf var/*'

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
