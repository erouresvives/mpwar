<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Flights\Application\Search;

use CodelyTv\Shared\Domain\Bus\Query\Query;

final class SearchFlightQuery implements Query
{

    private string $fromDate;
    private string $toDate;
    private string $destination;

    public function __construct(string $fromDate, string $toDate, string $destination)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->destination = $destination;
    }

    public function getFromDate(): string
    {
        return $this->fromDate;
    }

    public function getToDate(): string
    {
        return $this->toDate;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

}
