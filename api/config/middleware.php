<?php

declare(strict_types=1);

use App\Http\Middleware\ClearEmptyInputMiddleware;
use App\Http\Middleware\DomainExceptionHandler;
use App\Http\Middleware\IpAccessMiddleware;
use App\Http\Middleware\ValidationExceptionHandler;
use RKA\Middleware\IpAddress;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return static function (App $app): void {
    $app->add(ValidationExceptionHandler::class);
    $app->add(DomainExceptionHandler::class);
    $app->add(ClearEmptyInputMiddleware::class);
    $app->addBodyParsingMiddleware();
    $app->add(IpAccessMiddleware::class);
    $app->add(IpAddress::class);
    $app->add(ErrorMiddleware::class);
};
