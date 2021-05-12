<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Flights\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class InvalidFlightHours extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_flighthours';
    }

    protected function errorMessage(): string
    {
        return sprintf('The flight hours provided can not be lower than 1');
    }
}
