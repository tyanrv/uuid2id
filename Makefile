php-cli:
	docker-compose run --rm api-php-cli php cli.php ${args}

test:
	docker-compose run --rm api-php-cli composer test

init:
	docker-compose up -d

cmd:
	docker-compose run --rm api-php-cli ${cmd}

composer-install:
	docker-compose run --rm api-php-cli composer install

composer-autoload:
	docker-compose run --rm api-php-cli composer dump-autoload

composer-update:
	docker-compose run --rm api-php-cli composer update

composer-require:
	docker-compose run --rm api-php-cli composer require ${arg}

composer-remove:
	docker-compose run --rm api-php-cli composer remove ${arg}

composer-cmd:
	docker-compose run --rm api-php-cli composer ${arg}

phpcbf:
	docker-compose run --rm api-php-cli vendor/bin/phpcbf Module2/Unit2/src

phpcs:
	docker-compose run --rm api-php-cli vendor/bin/phpcs Module2/Unit2/src

phinx:
	docker-compose run --rm api-php-cli vendor/bin/phinx ${arg}

doctrine:
	docker-compose run --rm api-php-cli vendor/bin/doctrine ${arg}

images-rm:
	docker system prune -af
