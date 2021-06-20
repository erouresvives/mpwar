<?php


namespace CodelyTv\OpenFlight\Flights\Domain;

interface FlightCounterRepository
{
    public function insert(FlightCounter $flightCounter): void;

    public function update(string $destination): void;

    public function getFlightsCount(): array;

    public function getDestinationCount(string $destination): int;


}