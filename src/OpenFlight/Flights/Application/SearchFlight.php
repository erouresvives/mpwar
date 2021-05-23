<?php


namespace CodelyTv\OpenFlight\Flights\Application;


use CodelyTv\OpenFlight\Flights\Domain\FlightRepository;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;

class SearchFlight
{

    public function __construct(private FlightRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(DateTimeValueObject $fromDate, DateTimeValueObject $toDate): SearchFlightResponse
    {
        $flightsQueryResult = $this->repository->findDepartureDateBetweenDates($fromDate, $toDate);

        $flightResponses = [];
        foreach ($flightsQueryResult as $flight) {
            $flightResponses [] = new FlightResponse(
                $flight->getOrigin(),
                $flight->getDestination(),
                $flight->getFlightHours(),
                $flight->getPrice()->getValue(),
                $flight->getPrice()->getCurrency(),
                DateTimeValueObject::convertDateTimeToString($flight->getDepartureDate()),
                $flight->getAircraft(),
                $flight->getAirline()
            );
        }

        return new SearchFlightResponse($flightResponses);
    }
}