<?php

namespace App\Commons\Application\Service\PunkApi;

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GetBeersService
{
    public function __construct(
        private string $endpoint,
        private HttpClientInterface $client,
        private SluggerInterface $slugger
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function fetchBeersByFood(string $food): array {
        $content = "";

        try {
            $response = $this->client->request(
                'GET',
                sprintf('%s?food=%s', $this->endpoint, mb_strtolower($this->slugger->slug($food, '_')))
            );
            $status = $response->getStatusCode();
            $content = $response->toArray();
        } catch (ClientExceptionInterface $exception) {
            $status = $response->getStatusCode();
        }

        return [
            'status' => $status,
            'data' => $content
        ];
    }

    public function findById(string $id): array {
        $content = "";

        try {
            $response = $this->client->request(
                'GET',
                sprintf('%s/%s', $this->endpoint, $this->slugger->slug($id))
            );
            $status = $response->getStatusCode();
            $content = $response->toArray();
        } catch (ClientExceptionInterface $exception) {
            $status = $response->getStatusCode();
        }

        return [
            'status' => $status,
            'data' => $content
        ];
    }

}
