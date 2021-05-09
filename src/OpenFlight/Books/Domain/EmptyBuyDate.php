<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Books\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class EmptyBuyDate extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'invalid_empty_buy_date';
    }

    protected function errorMessage(): string
    {
        return sprintf('The buy date provided is empty');
    }
}
