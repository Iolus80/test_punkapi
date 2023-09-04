<?php

namespace App\Query\Beer\Application\Handler;

use App\Commons\Application\Service\DataHydrator\ObjectHydrator;
use App\Commons\Application\Service\PunkApi\GetBeersService;
use App\Query\Beer\Application\Model\BeerById;
use App\Query\Beer\Domain\BeerDto;

class GetBeerById implements BeerById
{
    public function __construct(
        public GetBeersService $punkApiService
    ){
    }

    public function findById(string $id): array {
        $result = $this->punkApiService->findById($id);
        $beer = [];

        if(null !== $result['data']) {
            $beer = array_map(function ($data) {
                return ObjectHydrator::hydrate($data, new BeerDto());
            }, $result['data']);
        }

        $content = [
            'status' => $result['status'],
            'data' => $beer
        ];

        return $content;
    }
}
