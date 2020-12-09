<?php

declare(strict_types=1);

namespace App\Http\Action\Transformer\UserTransformer;

use App\Http\EmptyResponse;
use App\Model\Transformer\Command\UserTransformer\Add\Command;
use App\Model\Transformer\Command\UserTransformer\Add\Handler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AddAction implements RequestHandlerInterface
{
    private Handler $handler;

    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /**
         * @psalm-var array{uuid:?string} $data
         */
        $data = $request->getParsedBody();

        $uuid = $data['uuid'] ?? '';

        $command = new Command();
        $command->uuid = $uuid;

        $this->handler->handle($command);

        return new EmptyResponse(201);
    }
}
