<?php

namespace App\Commons\Infrastructure\Normalizer;

use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

class CollectionNormalizer
{
    private Serializer $serializer;

    public function __construct()
    {
        $encoders = [];
        $normalizers = [new PropertyNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return true;
    }
}
