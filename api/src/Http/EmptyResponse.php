<?php

declare(strict_types=1);

namespace App\Http;

use Fig\Http\Message\StatusCodeInterface;
use Slim\Psr7\Response;

class EmptyResponse extends Response
{
    /**
     * JsonResponse constructor.
     * @param int $status
     */
    public function __construct(int $status = StatusCodeInterface::STATUS_OK)
    {
        parent::__construct($status);
    }
}
