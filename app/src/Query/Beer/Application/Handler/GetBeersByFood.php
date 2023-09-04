<?php

namespace App\Query\Beer\Application\Handler;

use App\Commons\Application\Service\DataHydrator\ObjectHydrator;
use App\Commons\Application\Service\PunkApi\GetBeersService;
use App\Query\Beer\Application\Model\BeersByFood;
use App\Query\Beer\Domain\BeerDto;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GetBeersByFood implements BeersByFood
{
    public function __construct(
        public GetBeersService $punkApiService
    ){
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function findByFood(string $food): array {
        $result = $this->punkApiService->fetchBeersByFood($food);
        $beers = [];

        if(null !== $result['data']) {
            $beers = array_map(function ($data) {
                return ObjectHydrator::hydrate($data, new BeerDto());
            }, $result['data']);
        }

        $content = [
            'status' => $result['status'],
            'data' => $beers
        ];

        return $content;
    }
}
