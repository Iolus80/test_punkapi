<?php

namespace App\Query\Beer\Domain;
class BeerDto
{
    public string $id;
    public string $name;
    public ?string $tagline;
    public ?string $first_brewed;
    public ?string $description;
    public ?string $image_url;
}
