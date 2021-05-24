<?php


namespace CodelyTv\OpenFlight\Flights\Application\Search;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class SearchFlightResponse implements Response
{

    private array $flights;

    public function __construct($flights)
    {
        $this->flights = $flights;
    }

    public function getFlights(): array
    {
        return $this->flights;
    }
}