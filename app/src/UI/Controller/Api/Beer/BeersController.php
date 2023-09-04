<?php

namespace App\UI\Controller\Api\Beer;

use App\Commons\Application\Service\PunkApi\GetBeersService;
use App\Query\Beer\Application\Model\BeerById;
use App\Query\Beer\Application\Model\BeerModel;
use App\Query\Beer\Application\Model\BeersByFood;
use App\UI\Controller\Api\AbstractJsonController;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


final class BeersController extends AbstractJsonController
{
    public function __construct(
        public GetBeersService $client,
        public SerializerInterface $serializer
    ){
        parent::__construct($this->serializer);
    }

    /**
     *
     * @Route("/api/beers", methods={"GET"})
     *
     * @OA\Parameter(
     *     in="query", name="food", required=true
     * )
     *
     * @OA\Response(
     *     response=200,
     *     description="Returns a list of beers filtered by type or dish of food.",
     *     @OA\JsonContent(
     *         @OA\Property(property="beers", type="array",
     *             @OA\Items(ref=@Model(type=BeerModel::class))
     *         )
     *     )
     * )
     * @OA\Response(
     *     response=400,
     *     description="Bad request"
     * )
     *
     * @OA\Response(
     *      response=404,
     *      description="Not Found"
     *  )
     *
     * @OA\Tag(name="Beers")
     *
     */
    public function getBeersByFood(Request $request, BeersByFood $beersByFood): Response {
        $food = $request->get("food");
        if(null === $food) {
            return $this->errorResponse(Response::HTTP_BAD_REQUEST, "Bad request");
        }

        $beers = $beersByFood->findByFood($food);

        if(Response::HTTP_OK !== $beers['status']) {
            return $this->errorResponse($beers['status']);
        }

        return $this->json($beers);
    }

    /**
     *
     * @Route("/api/beers/{id}", methods={"GET"})
     *
     * @OA\Response(
     *     response=200,
     *     description="Returns information on a beer",
     *     @OA\JsonContent(
     *         @OA\Property(property="beer", type="array",
     *             @OA\Items(ref=@Model(type=BeerModel::class))
     *         )
     *     )
     * )
     * @OA\Response(
     *     response=400,
     *     description="Bad request"
     * )
     *
     * @OA\Response(
     *      response=404,
     *      description="Not Found"
     *  )
     * @OA\Tag(name="Beers")
     *
     */
    public function getBeersById(Request $request, BeerById $beerById): Response {
        $id = $request->get("id");
        $beer = $beerById->findById($id);

        if(Response::HTTP_OK !== $beer['status']) {
            return $this->errorResponse($beer['status']);
        }

        return $this->json($beer);
    }
}
