<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Factory;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\Tools\Setup;
use Psr\Container\ContainerInterface;

class EntityManagerFactory
{
    public function __invoke(ContainerInterface $container): EntityManager
    {
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
    }
}