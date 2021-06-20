<?php


namespace CodelyTv\OpenFlight\Flights\Domain;

use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;

interface FlightRepository
{
    public function create(Flight $flight): void;
    public function findFlightDestinationBetweenDates(DateTimeValueObject $fromDate, DateTimeValueObject $toDate, string $destination): array;
}