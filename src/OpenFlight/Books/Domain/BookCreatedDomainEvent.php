<?php

declare(strict_types=1);


namespace CodelyTv\OpenFlight\Books\Domain;


use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use DateTime;

final class BookCreatedDomainEvent extends DomainEvent
{

    private DateTime $buyDate;
    private SeatValueObject $seat;
    private PriceValueObject $price;
    private Uuid $flightId;
    private Uuid $userId;
    private Luggage $luggage;

    public function __construct(
        Uuid $id,
        DateTime $buyDate,
        SeatValueObject $seat,
        PriceValueObject $price,
        Uuid $flightId,
        Uuid $userId,
        Luggage $luggage,
        string $eventId = null,
        string $occurredOn = null
    ) {
        $this->buyDate = $buyDate;
        $this->seat = $seat;
        $this->price = $price;
        $this->flightId = $flightId;
        $this->userId = $userId;
        $this->luggage = $luggage;
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
            $body["buyDate"],
            $body["seat"],
            $body["price"],
            $body["flightId"],
            $body["userId"],
            $body["luggage"],
            $eventId,
            $occurredOn,
        );
    }

    public static function eventName(): string
    {
        return "open_flight.v1.book.created";
    }

    public function toPrimitives(): array
    {
        return [
            "buyDate" => $this->buyDate,
            "seat" => $this->seat,
            "price" => $this->price,
            "flightId" => $this->flightId,
            "userId" => $this->userId,
            "luggage" => $this->luggage
        ];
    }
}