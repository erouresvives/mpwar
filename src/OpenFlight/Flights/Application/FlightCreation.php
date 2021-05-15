<?php


namespace CodelyTv\OpenFlight\Flights\Application;


use CodelyTv\OpenFlight\Flights\Domain\Flight;
use CodelyTv\OpenFlight\Flights\Domain\FlightRepository;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;


class FlightCreation
{

    public function __construct(private FlightRepository $repository, private EventBus $bus)
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
            PriceValueObject::createPrice(intval($price), $currency),
            DateTimeValueObject::createDateTimeValueObjectFromString($departureDate),
            $aircraft,
            $airline
        );
        $this->repository->create($flight);
        $this->bus->publish(...$flight->pullDomainEvents());
    }

}