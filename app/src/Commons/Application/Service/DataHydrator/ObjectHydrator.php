<?php

namespace App\Commons\Application\Service\DataHydrator;

abstract class ObjectHydrator
{
    public static function hydrate(array $content, object $dto): object
    {
        foreach ($content as $key => $value) {
            if (property_exists($dto, $key)) {
                $dto->$key = $value;
            }
        }
        return $dto;
    }
}
