<?php

declare(strict_types=1);

use App\Infrastructure\Doctrine\Factory\DiffCommandFactory;
use App\Infrastructure\Doctrine\Type\Transformer\IdTypeDb;
use App\Infrastructure\Doctrine\Type\Transformer\UUIDTypeDb;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;

return [
    EntityManagerInterface::class => function (ContainerInterface $container) {
        /**
         * @psalm-suppress MixedArrayAccess
         * @psalm-var array{
         *      metadata_dirs:array,
         *      dev_mode:bool,
         *      proxy_dir:string,
         *      cache_dir:?string,
         *      types:array<string,string>,
         *      connection:array
         * } $settings
         */
        $settings = $container->get('config')['doctrine'];
        $config = Setup::createAnnotationMetadataConfiguration(
            $settings['metadata_dirs'],
            $settings['dev_mode'],
            $settings['proxy_dir'],
            $settings['cache_dir'] ? new FilesystemCache($settings['cache_dir']) : new ArrayCache(),
            false
        );

        $config->setNamingStrategy(new UnderscoreNamingStrategy());

        foreach ($settings['types'] as $name => $class) {
            if (!Type::hasType($name)) {
                Type::addType($name, $class);
            }
        }

        return EntityManager::create(
            $settings['connection'],
            $config
        );
    },

    DiffCommand::class => DI\factory(DiffCommandFactory::class),

    'config' => [
        'doctrine' => [
            'dev_mode' => false,
            'cache_dir' => __DIR__ . '/../../var/cache/doctrine/cache',
            'proxy_dir' => __DIR__ . '/../../var/cache/doctrine/proxy',
            'connection' => [
                'driver' => 'pdo_pgsql',
                'host' => getenv('DB_HOST'),
                'user' => getenv('DB_USER'),
                'password' => getenv('DB_PASSWORD'),
                'dbname' => getenv('DB_NAME'),
                'charset' => 'utf-8'
            ],
            'metadata_dirs' => [
                __DIR__ . '/../../src/Model/Transformer/Entity/GoodsTransformer',
                __DIR__ . '/../../src/Model/Transformer/Entity/UserTransformer'
            ],
            'types' => [
                IdTypeDb::NAME => IdTypeDb::class,
                UUIDTypeDb::NAME => UUIDTypeDb::class
            ]
        ],
    ],
];
