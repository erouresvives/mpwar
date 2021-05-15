<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Users\Application\Register;

use CodelyTv\Shared\Domain\Bus\Command\Command;

final class RegisterUserCommand implements Command
{

    private string $id;
    private string $username;
    private string $name;
    private string $lastname;
    private string $password;


    public function __construct(string $id, string $username, string $name, string $lastname, string $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->password = $password;
    }

    public function getId(): string
    {
        return $this->id;
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
        return $this->lastname;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

}
