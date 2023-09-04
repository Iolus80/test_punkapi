<?php

namespace App\Query\Beer\Application\Model;

use OpenApi\Annotations as OA;

class BeerModel
{
    /**
     * @var string
     * @OA\Property(property="id", type="string", example="192")
     */
    public string $id;

    /**
     * @var string
     * @OA\Property(property="name", type="string", example="Punk IPA 2007 - 2010")
     */
    public string $name;

    /**
     * @var string
     * @OA\Property(property="tagline", type="string", example="Post Modern Classic. Spiky. Tropical. Hoppy.")
     */
    public string $tagline;

    /**
     * @var string
     * @OA\Property(property="first_brewed", type="string", example="04/2007")
     */
    public string $first_brewed;

    /**
     * @var string
     * @OA\Property(property="description", type="string", example="Our flagship beer that kick started the craft beer revolution.")
     */
    public string $description;

    /**
     * @var string
     * @OA\Property(property="image_url", type="string", example="https://images.punkapi.com/v2/192.png")
     */
    public string $image_url;
}
