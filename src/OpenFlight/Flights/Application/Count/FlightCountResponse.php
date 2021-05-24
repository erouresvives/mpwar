<?php


namespace CodelyTv\OpenFlight\Flights\Application\Count;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class FlightCountResponse implements Response
{

    private string $destination;
    private int $totalTrips;

    public function __construct(string $destination, int $totalTrips)
    {
        $this->destination = $destination;
        $this->totalTrips = $totalTrips;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getTotalTrips(): int
    {
        return $this->totalTrips;
    }

}