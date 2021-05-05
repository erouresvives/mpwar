<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Flights\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class EmptyAircraft extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_aircraft';
    }

    protected function errorMessage(): string
    {
        return sprintf('The aircraft provided is empty');
    }
}
