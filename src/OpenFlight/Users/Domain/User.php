<?php


namespace CodelyTv\OpenFlight\Users\Domain;


use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class User extends AggregateRoot
{
    const pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    private Uuid $id;
    private string $username;
    private string $name;
    private string $lastname;
    private string $password;

    public function __construct(Uuid $id, string $username, string $name, string $lastname, string $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->password = $password;
    }

    public function ID(): Uuid
    {
        return $this->id;
    }

    public function Username(): string
    {
        return $this->username;
    }

    public function Name(): string
    {
        return $this->name;
    }

    public function LastName(): string
    {
        return $this->lastname;
    }

    public function Password(): string
    {
        return $this->password;
    }

    public static function RegisterUser(
        Uuid $id,
        string $username,
        string $name,
        string $lastname,
        string $password
    ): User {
        self::validateUsername($username);
        self::validateName($name);
        self::validateLastName($lastname);
        self::validatePassword($password);
        return new self($id, $username, $name, $lastname, $password);
    }

    private static function validateName(string $name): void
    {
        if ($name == "") {
            throw new EmptyName();
        }
    }

    private static function validateUsername(string $username): void
    {
        if ($username == "") {
            throw new EmptyUsername();
        }
    }

    private static function validateLastName(string $lastname): void
    {
        if ($lastname == "") {
            throw new EmptyLastName();
        }
    }

    public static function validatePassword(string $password): void
    {
        if (!preg_match(self::pattern, $password)) {
            throw new InvalidPassword($password);
        }
    }

    public function Login(string $password): void
    {
        if ($this->password !== $password) {
            throw new IncorrectPassword();
        }
    }
}