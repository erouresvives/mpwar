<?php

declare(strict_types=1);


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Flights;


use CodelyTv\OpenFlight\Flights\Application\Count\FlightCountQuery;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class CountFlightsGetController extends ApiController
{

    public function __invoke(): JsonResponse
    {
        $response = $this->ask(
            new FlightCountQuery()
        );

        $flightCountResponses = [];
        foreach ($response->getFlights() as $flightCount) {
            $flightCountResponses [] = [
                'destination' => $flightCount->getDestination(),
                'totalTrips' => $flightCount->getTotalTrips()
            ];
        }

        return new JsonResponse(
            $flightCountResponses,
            Response::HTTP_OK
        );
    }

    protected function exceptions(): array
    {
        return [];
    }

}