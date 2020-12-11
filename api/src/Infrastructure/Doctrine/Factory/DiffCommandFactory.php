<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Factory;

use Doctrine\Migrations\Provider\OrmSchemaProvider;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;

class DiffCommandFactory
{
    public function __invoke(ContainerInterface $container): Command
    {
        /** @var EntityManagerInterface $em */
        $em = $container->get(EntityManagerInterface::class);
        return new DiffCommand(
            new OrmSchemaProvider($em)
        );
    }
}
