<?php


namespace CodelyTv\OpenFlight\Flights\Domain;

use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;

interface FlightRepository
{
    public function create(Flight $flight): void;
    public function findDepartureDateBetweenDates(DateTimeValueObject $fromDate, DateTimeValueObject $toDate): array;
}