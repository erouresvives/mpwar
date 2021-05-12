<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Flights\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class InvalidDepartureDate extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_departure_date';
    }

    protected function errorMessage(): string
    {
        return sprintf('The departure date provided is earlier than current date');
    }
}
