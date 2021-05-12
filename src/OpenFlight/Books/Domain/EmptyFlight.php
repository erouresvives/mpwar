<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Books\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class EmptyFlight extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_empty_flight_id';
    }

    protected function errorMessage(): string
    {
        return sprintf('The flight provided is empty');
    }
}
