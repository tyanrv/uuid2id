<?php

declare(strict_types=1);

use App\Http\Middleware\ClearEmptyInputMiddleware;
use App\Http\Middleware\DomainExceptionHandler;
use App\Http\Middleware\ValidationExceptionHandler;
use Psr\Container\ContainerInterface;
use Slim\App;

return static function (App $app, ContainerInterface $container): void {
    $app->add(ValidationExceptionHandler::class);
    $app->add(DomainExceptionHandler::class);
    $app->add(ClearEmptyInputMiddleware::class);
    $app->addBodyParsingMiddleware();
    /** @psalm-var array{debug:bool} $config */
    $config = $container->get('config');
    $app->addErrorMiddleware($config['debug'], $config['env'] !== 'test', true);
};
