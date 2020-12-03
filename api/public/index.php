<?php

declare(strict_types=1);

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Factory\AppFactory;
use DI\Container;

http_response_code(500);

require_once __DIR__ . '/../vendor/autoload.php';

$container = new Container();

$app = AppFactory::create();

$app->addErrorMiddleware((bool) getenv('APP_DEBUG'), true, true);

$app->get('/', function (RequestInterface $request, ResponseInterface $response, $args) {
    $response->getBody()->write('{}');
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
