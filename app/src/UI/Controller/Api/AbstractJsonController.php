<?php

namespace App\UI\Controller\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
abstract class AbstractJsonController
{
    public function __construct(
        protected SerializerInterface $serializer
    ){
    }

    protected function json(mixed $data): JsonResponse
    {
        $content = $this->serializer->serialize($data,'json');

        return new JsonResponse($content, Response::HTTP_OK, [], true);
    }

    protected function errorResponse(int $statusCode, string $msg = "There has been an error processing the request, please check the parameters. ") {
        return new JsonResponse(json_encode(["status" => $statusCode, "message" => $msg]), $statusCode, [], true);
    }
}
