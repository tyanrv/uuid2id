php-cli:
	docker-compose run --rm api-php-cli php cli.php ${args}

test:
	docker-compose run --rm api-php-cli composer test

init:
	docker-compose up -d

cmd:
	docker-compose run --rm api-php-cli ${cmd}

console:
	docker-compose run --rm api-php-cli php bin/app.php ${args}

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

phinx:
	docker-compose run --rm api-php-cli vendor/bin/phinx ${arg}

phpunit:
	docker-compose run --rm api-php-cli vendor/bin/phpunit ${arg}


doctrine:
	docker-compose run --rm api-php-cli vendor/bin/doctrine ${arg}

images-rm:
	docker system prune -af
