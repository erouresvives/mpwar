<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Books\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class InvalidWeightUnit extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_weight_unit';
    }

    protected function errorMessage(): string
    {
        return sprintf('The weight unit is incorrect.');
    }
}
