<?php

declare(strict_types=1);


namespace CodelyTv\OpenFlight\Users\Domain;


use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

final class UserLoggedDomainEvent extends DomainEvent
{
    private string $username;
    private string $name;
    private string $lastname;
    private string $password;

    public function __construct(
        Uuid $id,
        string $username,
        string $name,
        string $lastname,
        string $password,
        string $eventId = null,
        string $occurredOn = null
    ) {
        $this->username = $username;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->password = $password;
        parent::__construct($id->value(), $eventId, $occurredOn);
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent {
        return new self(
            new Uuid($aggregateId),
            $body["username"],
            $body["name"],
            $body["lastname"],
            $body["password"],
            $eventId,
            $occurredOn,
        );
    }

    public static function eventName(): string
    {
        return "open_flight.v1.user.logged";
    }

    public function toPrimitives(): array
    {
        return [
            "username" => $this->username,
            "password" => $this->password,
            "lastname" => $this->lastname,
            "name" => $this->name,
        ];
    }
}