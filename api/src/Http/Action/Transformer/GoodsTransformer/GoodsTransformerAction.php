<?php

declare(strict_types=1);

namespace App\Http\Action\Transformer\GoodsTransformer;

use App\Http\JsonResponse;
use App\Http\Validator\Validator;
use App\Model\Transformer\Command\GoodsTransformer\GoodsTransformer\Command;
use App\ReadModel\Transformer\GoodsTransformer\GoodsTransformerFetcher;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GoodsTransformerAction implements RequestHandlerInterface
{
    private GoodsTransformerFetcher $fetcher;
    private Validator $validator;

    /**
     * GoodsTransformerAction constructor.
     * @param GoodsTransformerFetcher $fetcher
     * @param Validator $validator
     */
    public function __construct(GoodsTransformerFetcher $fetcher, Validator $validator)
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

        $arrGoodsTransformer = $this->fetcher->getGoodsTransformerByUUID($command);

        return new JsonResponse($arrGoodsTransformer);
    }
}
