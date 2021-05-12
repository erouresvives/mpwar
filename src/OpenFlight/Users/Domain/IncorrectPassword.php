<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Users\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\DomainError;

final class IncorrectPassword extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }
 
    public function errorCode(): string
    {
        return 'incorrect_password';
    }

    protected function errorMessage(): string
    {
        return sprintf('Incorrect credentials');
    }
}
