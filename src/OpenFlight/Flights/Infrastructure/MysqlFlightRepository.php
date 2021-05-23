<?php

declare(strict_types=1);


namespace CodelyTv\OpenFlight\Flights\Infrastructure;


use CodelyTv\OpenFlight\Flights\Domain\Flight;
use CodelyTv\OpenFlight\Flights\Domain\FlightRepository;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Infrastructure\Persistence\Mysql;


final class MysqlFlightRepository implements FlightRepository
{
    public function __construct(private Mysql $mysql)
    {
    }

    public function create(Flight $flight): void
    {
        $sql = 'INSERT IGNORE INTO flight VALUES(:id, :origin, :destination, :flightHours, :price, :currency, :departureDate, :aircraft, :airline)';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':id', $flight->getId()->value());
        $statement->bindValue(':origin', $flight->getOrigin());
        $statement->bindValue(':destination', $flight->getDestination());
        $statement->bindValue(':flightHours', $flight->getFlightHours());
        $statement->bindValue(':price', $flight->getPrice()->getValue());
        $statement->bindValue(':currency', $flight->getPrice()->getCurrency());
        $statement->bindValue(
            ':departureDate',
            DateTimeValueObject::convertDateTimeToString($flight->getDepartureDate())
        );
        $statement->bindValue(':aircraft', $flight->getAircraft());
        $statement->bindValue(':airline', $flight->getAirline());
        $statement->execute();
    }

    public function findDepartureDateBetweenDates(DateTimeValueObject $fromDate, DateTimeValueObject $toDate): array
    {

        $sql = 'SELECT * FROM flight WHERE `Departure-date` BETWEEN :fromDate AND :toDate';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':fromDate',
            DateTimeValueObject::convertDateTimeToString($fromDate)
        );
        $statement->bindValue(':toDate',
            DateTimeValueObject::convertDateTimeToString($toDate)
        );

        $statement->execute();
        $flights = $statement->fetchAll();

        $foundFlights = [];

        foreach ($flights as $flight) {
            $uuid = new Uuid($flight["Id"]);
            $foundFlights [] = new Flight($uuid,
                $flight["Origin"],
                $flight["Destination"],
                intval(["Flight-hours"]),
                PriceValueObject::createPrice(intval($flight["Price"]), $flight["Currency"]),
                DateTimeValueObject::createDateTimeValueObjectFromString($flight["Departure-date"]),
                $flight["Aircraft"],
                $flight["Airline"]);
        }

        return $foundFlights;
    }
}