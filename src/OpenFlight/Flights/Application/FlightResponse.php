<?php


namespace CodelyTv\OpenFlight\Flights\Application;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class FlightResponse implements Response
{

    private string $origin;
    private string $destination;
    private int $flightHours;
    private int $price;
    private string $currency;
    private string $departureDate;
    private string $aircraft;
    private string $airline;

    public function __construct(string $origin, string $destination, int $flightHours, string $price, string $currency, string $departureDate,
                                string $aircraft, string $airline)
    {
        $this->origin = $origin;
        $this->destination = $destination;
        $this->flightHours = $flightHours;
        $this->price = $price;
        $this->currency = $currency;
        $this->departureDate = $departureDate;
        $this->aircraft = $aircraft;
        $this->airline = $airline;
    }

    public function getOrigin(): string
    {
        return $this->origin;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getFlightHours(): int
    {
        return $this->flightHours;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getDepartureDate(): string
    {
        return $this->departureDate;
    }

    public function getAircraft(): string
    {
        return $this->aircraft;
    }

    public function getAirline(): string
    {
        return $this->airline;
    }
}