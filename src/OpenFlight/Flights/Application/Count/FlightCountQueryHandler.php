<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Flights\Application\Count;

use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

final class FlightCountQueryHandler implements QueryHandler
{

    public function __construct(private FlightCount $flightCount)
    {
    }

    public function __invoke(FlightCountQuery $query): FlightsCountResponse
    {
        return $this->flightCount->__invoke();
    }
}
