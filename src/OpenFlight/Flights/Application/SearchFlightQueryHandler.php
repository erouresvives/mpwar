<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Flights\Application;

use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;

final class SearchFlightQueryHandler implements QueryHandler
{

    public function __construct(private SearchFlight $searchFlight)
    {
    }

    public function __invoke(SearchFlightQuery $query): SearchFlightResponse
    {
        return $this->searchFlight->__invoke(
            DateTimeValueObject::createDateTimeValueObjectFromString($query->getFromDate()),
            DateTimeValueObject::createDateTimeValueObjectFromString($query->getToDate())
        );
    }
}
