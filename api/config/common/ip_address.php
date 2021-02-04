<?php

declare(strict_types=1);

use App\Http\Middleware\IpAccessMiddleware;
use Psr\Container\ContainerInterface;

return [
    IpAccessMiddleware::class => static function (ContainerInterface $container) {
        /**
         * @psalm-suppress MixedArrayAccess
         * @psalm-var array{
         *      accessible:array
         * } $config
         */
        $config = $container->get('config')['ip_address'];
        $accessibleIpAddresses = $config['accessible'];

        return new IpAccessMiddleware($accessibleIpAddresses);
    },

    'config' => [
        'ip_address' => [
            'accessible' => [
                '172.19.0.3',
                '172.19.0.2',
                '127.0.0.1',
                '99.99.99.99'
            ]
        ],
    ],
];
