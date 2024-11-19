<?php

namespace App\Service;

use GRPC\Pinger\PingerInterface;
use Spiral\RoadRunner\GRPC;
use GRPC\Pinger\PingRequest;
use GRPC\Pinger\PingResponse;

final class Pinger implements PingerInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient
    ) {
    }

    public function ping(GRPC\ContextInterface $ctx, PingRequest $in): PingResponse
    {
        $statusCode = $this->httpClient->get($in->getUrl())->getStatusCode();

        return new PingResponse([
            'status_code' => $statusCode
        ]);
    }
}