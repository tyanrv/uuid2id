<?php

declare(strict_types=1);

use App\Http\Action\HomeAction;
use DI\ContainerBuilder;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ResponseFactory;

http_response_code(500);

require_once __DIR__ . '/../vendor/autoload.php';

$builder = new ContainerBuilder();

$builder->addDefinitions([
    'config' => [
        'debug' => (bool)getenv('APP_DEBUG')
    ],
    ResponseFactoryInterface::class => DI\get(ResponseFactory::class)
]);

$container = $builder->build();

$app = AppFactory::createFromContainer($container);

$app->addErrorMiddleware($container->get('config')['debug'], true, true);

$app->get('/', function (RequestInterface $request, ResponseInterface $response, $args) {
    $response->getBody()->write('{}');
    return $response->withHeader('Content-Type', 'application/json');
});
$app->get('/home', HomeAction::class);

$app->run();
