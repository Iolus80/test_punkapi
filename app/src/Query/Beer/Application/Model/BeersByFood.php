<?php

namespace App\Query\Beer\Application\Model;

interface BeersByFood
{
    public function findByFood(string $food): array;
}
