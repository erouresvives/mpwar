<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\ValueObject;

use CodelyTv\Shared\Domain\DomainError;

final class InvalidCurrency extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_currency_type';
    }

    protected function errorMessage(): string
    {
        return sprintf('The currency provided does not match with $, € or £');
    }
}
