<?php

declare(strict_types=1);

use App\Infrastructure\Doctrine\Factory\DiffCommandFactory;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\UpToDateCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand;

return [

    DiffCommand::class => DI\factory(DiffCommandFactory::class),

    'config' => [
        'console' => [
            'commands' => [
                CreateCommand::class,
                DropCommand::class,
                ExecuteCommand::class,
                GenerateCommand::class,
                LatestCommand::class,
                MigrateCommand::class,
                DiffCommand::class,
                UpToDateCommand::class,
                StatusCommand::class,
                VersionCommand::class,
            ]
        ]
    ]
];
