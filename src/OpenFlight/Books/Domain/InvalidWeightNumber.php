<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Books\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class InvalidWeightNumber extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_weight_number';
    }

    protected function errorMessage(): string
    {
        return sprintf('The weight number is incorrect.');
    }
}
