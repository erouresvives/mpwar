<?php


namespace CodelyTv\OpenFlight\Flights\Application\Count;


use CodelyTv\OpenFlight\Flights\Domain\FlightCounterRepository;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

class FlightCount
{

    public function __construct(private FlightCounterRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(): FlightsCountResponse
    {
        $flightsCounterQueryResult = $this->repository->getFlightsCount();

        $flightCounterResponses = [];
        foreach ($flightsCounterQueryResult as $flightCounter) {
            $flightCounterResponses [] = new FlightCountResponse(
                $flightCounter->getDestination(),
                $flightCounter->getTotalTrips()
            );
        }

        return new FlightsCountResponse($flightCounterResponses);
    }
}