<?php


namespace CodelyTv\OpenFlight\Flights\Domain;

interface FlightRepository
{
    public function create(Flight $flight): void;
}