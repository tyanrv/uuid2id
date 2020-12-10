<?php

declare(strict_types=1);

use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand;

return [
    'config' => [
        'console' => [
            'commands' => [
                DropCommand::class,

                GenerateCommand::class,
                DiffCommand::class,

                VersionCommand::class,
            ]
        ]
    ]
];
