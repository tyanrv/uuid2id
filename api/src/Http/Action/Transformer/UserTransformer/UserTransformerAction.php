<?php

declare(strict_types=1);

namespace App\Http\Action\Transformer\UserTransformer;

use App\Http\JsonResponse;
use App\Http\Validator\Validator;
use App\Model\Transformer\Command\UserTransformer\UserTransformer\Command;
use App\ReadModel\Transformer\UserTransformer\UserTransformerFetcher;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UserTransformerAction implements RequestHandlerInterface
{
    private UserTransformerFetcher $fetcher;
    private Validator $validator;

    /**
     * UserTransformerAction constructor.
     * @param UserTransformerFetcher $fetcher
     * @param Validator $validator
     */
    public function __construct(UserTransformerFetcher $fetcher, Validator $validator)
    {
        $this->fetcher = $fetcher;
        $this->validator = $validator;
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /**
         * @psalm-var array{uuid:?string} $data
         */
        $data = $request->getQueryParams();

        $uuid = $data['uuid'] ?? '';

        $command = new Command();
        $command->uuid = $uuid;

        $this->validator->validate($command);

        $arrUserTransformer = $this->fetcher->getUserTransformerByUUID($command);

        return new JsonResponse($arrUserTransformer);
    }
}
