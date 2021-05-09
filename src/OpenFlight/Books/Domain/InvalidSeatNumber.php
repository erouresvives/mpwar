<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Books\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class InvalidSeatNumber extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_seat_number';
    }

    protected function errorMessage(): string
    {
        return sprintf('The seat number is incorrect.');
    }
}
