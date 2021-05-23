<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Users\Application\Login;

use CodelyTv\Shared\Domain\Bus\Query\Query;

final class FindUserLoginQuery implements Query
{
    private string $username;
    private string $password;


    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
