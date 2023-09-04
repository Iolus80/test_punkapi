<?php

namespace App\Test\UI\Controller\Api\Beer;

use App\Commons\Application\Service\PunkApi\GetBeersService;
use App\Query\Beer\Application\Handler\GetBeerById;
use App\Query\Beer\Application\Handler\GetBeersByFood;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class GetBeerByIdTest extends KernelTestCase
{
    protected function setUp(): void
    {
        $this->container = self::bootKernel()->getContainer();
        $this->getBeersServiceMock = $this->createMock(GetBeersService::class);

        $containerBuilder = new ContainerBuilder();
        $containerBuilder->set(ContainerInterface::class, $this->container);
        $containerBuilder->set(GetBeersService::class, $this->getBeersServiceMock);

        $this->beerById = new GetBeerById($containerBuilder->get(GetBeersService::class));
    }

    public function testGetBeerById(): void {
        $id = '192';

        $this->getBeersServiceMock->expects(self::once())
            ->method('findById')
            ->with($id)
            ->willReturn(
                [
                    "status" => "200",
                    "data" => [
                        [
                            "id" => "192",
                            "name" => "Punk IPA 2007 - 2010",
                            "tagline" => "Post Modern Classic. Spiky. Tropical. Hoppy.",
                            "first_brewed" => "04/2007",
                            "description" => "Our flagship beer that kick started the craft beer revolution. This is James and Martin's original take on an American IPA, subverted with punchy New Zealand hops. Layered with new world hops to create an all-out riot of grapefruit, pineapple and lychee before a spiky, mouth-puckering bitter finish.",
                            "image_url" => "https://images.punkapi.com/v2/192.png"
                        ]
                    ]
                ]
            );
        $result = $this->beerById->findById($id);

        $this->assertNotNull($result['data']);
        $this->assertEquals(Response::HTTP_OK, $result['status']);
        $this->assertCount(1, $result['data']);
    }
}
