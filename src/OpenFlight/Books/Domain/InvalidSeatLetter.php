<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Books\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class InvalidSeatLetter extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_seat_letter';
    }

    protected function errorMessage(): string
    {
        return sprintf('The seat letter is incorrect.');
    }
}
