<?php

namespace App\Query\Beer\Application\Model;

interface BeerById
{
    public function findById(string $id): array;
}
