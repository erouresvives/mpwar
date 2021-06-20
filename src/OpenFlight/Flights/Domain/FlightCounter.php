<?php


namespace CodelyTv\OpenFlight\Flights\Domain;

use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class FlightCounter extends AggregateRoot
{

    private Uuid $id;
    private string $destination;
    private int $totalTrips;

    public function __construct(Uuid $id, string $destination, int $totalTrips)
    {
        $this->id = $id;
        $this->destination = $destination;
        $this->totalTrips = $totalTrips;
    }

    public function getId(): Uuid
    {
        return $this->id;
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