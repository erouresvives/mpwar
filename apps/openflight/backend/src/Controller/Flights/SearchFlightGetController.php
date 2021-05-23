<?php

declare(strict_types=1);


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Flights;


use CodelyTv\OpenFlight\Flights\Application\SearchFlightQuery;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class SearchFlightGetController extends ApiController
{

    public function __invoke(string $dateFrom, string $dateTo): JsonResponse
    {
        $response = $this->ask(
            new SearchFlightQuery(
                $dateFrom, $dateTo
            )
        );

        $flightResponses = [];
        foreach ($response->getFlights() as $flight) {
            $flightResponses [] = [
                'origin' => $flight->getOrigin(),
                'destination' => $flight->getDestination(),
                'flightHours' => $flight->getFlightHours(),
                'price' => $flight->getPrice(),
                'currency' => $flight->getCurrency(),
                'departureDate' => $flight->getDepartureDate(),
                'aircraft' => $flight->getAircraft(),
                'airline' => $flight->getAirline()
            ];
        }

        return new JsonResponse(
            $flightResponses,
            Response::HTTP_OK
        );
    }

    protected function exceptions(): array
    {
        return [];
    }

}