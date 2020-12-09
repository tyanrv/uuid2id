<?php

declare(strict_types=1);

use App\Infrastructure\Doctrine\Factory\DiffCommandFactory;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;

return [
    DiffCommand::class => DI\factory(DiffCommandFactory::class),

    'config' => [
        'doctrine' => [
            'dev_mode' => true,
            'cache_dir' => __DIR__ .  '/../../var/cache/' . PHP_SAPI . '/doctrine/cache',
            'proxy_dir' => __DIR__ .  '/../../var/cache/' . PHP_SAPI . '/doctrine/proxy',
        ],
    ],
];
