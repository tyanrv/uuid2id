<?php

declare(strict_types=1);

namespace App\Http\Action\Transformer\GoodsTransformer;

use App\Http\EmptyResponse;
use App\Http\JsonResponse;
use App\Model\Transformer\Command\GoodsTransformer\Add\Command;
use App\Model\Transformer\Command\GoodsTransformer\Add\Handler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AddAction implements RequestHandlerInterface
{
    private Handler $handler;
    private ValidatorInterface $validator;

    public function __construct(Handler $handler, ValidatorInterface $validator)
    {
        $this->handler = $handler;
        $this->validator = $validator;
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

        $violations = $this->validator->validate($command);

        if ($violations->count() > 0) {
            $errors = [];
            /** @var ConstraintViolationInterface $violation */
            foreach ($violations as $violation) {
                $errors[$violation->getPropertyPath()] = $violation->getMessage();
            }
            return new JsonResponse(['errors' => $errors], 422);
        }

        $this->handler->handle($command);

        return new EmptyResponse(201);
    }
}
