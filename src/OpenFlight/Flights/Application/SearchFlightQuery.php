<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Flights\Application;

use CodelyTv\Shared\Domain\Bus\Query\Query;

final class SearchFlightQuery implements Query
{

    private string $fromDate;
    private string $toDate;

    public function __construct(string $fromDate, string $toDate)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function getFromDate(): string
    {
        return $this->fromDate;
    }

    public function getToDate(): string
    {
        return $this->toDate;
    }
}
