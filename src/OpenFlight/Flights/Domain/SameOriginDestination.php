<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Flights\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class SameOriginDestination extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'same_origin_destination';
    }

    protected function errorMessage(): string
    {
        return sprintf('The origin and the destination are the same');
    }
}
