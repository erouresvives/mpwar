<?php

declare(strict_types=1);


namespace CodelyTv\OpenFlight\Users\Infrastructure;


use CodelyTv\OpenFlight\Users\Domain\IncorrectUserName;
use CodelyTv\OpenFlight\Users\Domain\User;
use CodelyTv\OpenFlight\Users\Domain\UserRepository;
use CodelyTv\Shared\Infrastructure\Persistence\Mysql;
use CodelyTv\Shared\Domain\ValueObject\Uuid;


final class MysqlUserRepository implements UserRepository
{
    public function __construct(private Mysql $mysql)
    {
    }

    public function Save(User $user): void
    {
        $sql = 'INSERT INTO user VALUES(:id, :username, :name,:last_name, :password)';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':id', $user->ID()->value());
        $statement->bindValue(':username', $user->Username());
        $statement->bindValue(':name', $user->Name());
        $statement->bindValue(':last_name', $user->LastName());
        $statement->bindValue(':password', $user->Password());
        $statement->execute();
    }

    public function findByUsername(string $username): User
    {
        $sql = 'SELECT * FROM user WHERE username = :username LIMIT 1';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $userArr = $statement->fetchAll();

        if (empty($userArr)) {
            throw new IncorrectUserName();
        }

        $uuid = new Uuid($user["Id"]);
        return User::LoginUser($uuid, $user["Username"], $user["Name"], $user["LastName"], $user["Password"]);
    }
}