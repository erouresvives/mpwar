<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Flights\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class EmptyAirline extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_airline';
    }

    protected function errorMessage(): string
    {
        return sprintf('The airline provided is empty');
    }
}
