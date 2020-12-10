<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

return static function (ContainerInterface $container): App {
    $app = AppFactory::createFromContainer($container);

    $middleware = require __DIR__ . '/../config/middleware.php';
    $middleware($app);

    $routes = require __DIR__ . '/../config/routes.php';
    $routes($app);

    return $app;
};
