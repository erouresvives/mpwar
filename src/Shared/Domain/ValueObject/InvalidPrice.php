<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\ValueObject;

use CodelyTv\Shared\Domain\DomainError;

final class InvalidPrice extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_price';
    }

    protected function errorMessage(): string
    {
        return sprintf('The price provided can not be lower than 0');
    }
}
