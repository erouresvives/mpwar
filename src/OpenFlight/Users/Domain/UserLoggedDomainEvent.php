<?php

declare(strict_types=1);


namespace CodelyTv\OpenFlight\Users\Domain;


use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

final class UserLoggedDomainEvent extends DomainEvent
{

    public function __construct(
        Uuid $id,
        string $eventId = null,
        string $occurredOn = null
    ) {
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
        ];
    }
}