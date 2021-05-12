<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Books\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class EmptyUser extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_empty_user_id';
    }

    protected function errorMessage(): string
    {
        return sprintf('The user provided is empty');
    }
}
