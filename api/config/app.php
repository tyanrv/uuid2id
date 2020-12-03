<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

return static function (ContainerInterface $container): App
{
    $app = AppFactory::createFromContainer($container);

    $middleware = require_once __DIR__ . '/../config/middleware.php';
    $middleware($app, $container);

    $routes = require_once __DIR__ . '/../config/routes.php';
    $routes($app);

    return $app;
};
