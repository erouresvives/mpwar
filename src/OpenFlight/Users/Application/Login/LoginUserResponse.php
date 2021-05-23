<?php


namespace CodelyTv\OpenFlight\Users\Application\Login;


use CodelyTv\Shared\Domain\Bus\Query\Response;

final class LoginUserResponse implements Response
{
    private string $username;
    private string $name;
    private string $lastName;

    public function __construct(string $username, string $name, string $lastName)
    {
        $this->username = $username;
        $this->name = $name;
        $this->lastName = $lastName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

}