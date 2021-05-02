<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Users\Domain;

use CodelyTv\Shared\Domain\DomainError;


final class IncorrectUserName extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'incorrect_user_name';
    }

    protected function errorMessage(): string
    {
        return sprintf('Incorrect credentials');
    }
}
