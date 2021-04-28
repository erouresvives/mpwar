<?php


namespace CodelyTv\OpenFlight\Flights\Application;


use CodelyTv\OpenFlight\Flights\Domain\Flight;
use CodelyTv\OpenFlight\Flights\Domain\FlightRepository;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use DateTime;

class FlightCreation
{

    public function __construct(private FlightRepository $repository)
    {
    }

    public function __invoke(
        string $id,
        string $origin,
        string $destination,
        string $flightHours,
        string $price,
        string $currency,
        string $departureDate,
        string $aircraft,
        string $airline
    ): void {
        $uuid = new Uuid($id);

        $flight = Flight::CreateFlight(
            $uuid,
            $origin,
            $destination,
            intval($flightHours),
            intval($price),
            $currency,
            Flight::convertDepartureDateToDatetime($departureDate),
            $aircraft,
            $airline
        );
        $this->repository->create($flight);
    }

}