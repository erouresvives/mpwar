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
        int $flightHours,
        int $price,
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
            $flightHours,
            $price,
            $currency,
            DateTime::createFromFormat('Y-m-d H:i:s', $departureDate),
            $aircraft,
            $airline
        );
        $this->repository->create($flight);
    }

}