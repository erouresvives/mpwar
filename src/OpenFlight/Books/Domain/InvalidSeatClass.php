<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Books\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class InvalidSeatClass extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_seat_class';
    }

    protected function errorMessage(): string
    {
        return sprintf('The seat class is incorrect.');
    }
}
