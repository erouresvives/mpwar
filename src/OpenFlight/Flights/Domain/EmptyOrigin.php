<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Flights\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class EmptyOrigin extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_origin';
    }

    protected function errorMessage(): string
    {
        return sprintf('The origin provided is empty');
    }
}
