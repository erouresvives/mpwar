<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Books\Application\Search;

use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

final class SearchBooksByUserQueryHandler implements QueryHandler
{

    public function __construct(private SearchBooksByUser $searchBooksByUser)
    {
    }

    public function __invoke(SearchBooksByUserQuery $query): SearchBooksByUserResponse
    {
        return $this->searchBooksByUser->__invoke(
            new Uuid($query->getUserId()),
        );
    }
}
