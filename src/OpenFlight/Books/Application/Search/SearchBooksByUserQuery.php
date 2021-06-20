<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Books\Application\Search;

use CodelyTv\Shared\Domain\Bus\Query\Query;

final class SearchBooksByUserQuery implements Query
{
    private string $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
