<?php

declare(strict_types=1);


namespace CodelyTv\OpenFlight\Books\Domain;


use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

final class BookCreatedDomainEvent extends DomainEvent
{

    private string $buyDate;
    private int $seatNumber;
    private string $seatLetter;
    private string $seatClass;
    private int $priceValue;
    private string $priceCurrency;
    private string $flightId;
    private string $userId;
    private string $luggageId;
    private string $luggageType;
    private int $luggageWeightNumber;
    private string $luggageWeightUnit;

    public function __construct(
        Uuid $id,
        string $buyDate,
        int $seatNumber,
        string $seatLetter,
        string $seatClass,
        int $priceValue,
        string $priceCurrency,
        string $flightId,
        string $userId,
        string $luggageId,
        string $luggageType,
        int $luggageWeightNumber,
        string $luggageWeightUnit,
        string $eventId = null,
        string $occurredOn = null
    ) {
        $this->buyDate = $buyDate;
        $this->seatNumber = $seatNumber;
        $this->seatLetter = $seatLetter;
        $this->seatClass = $seatClass;
        $this->priceValue = $priceValue;
        $this->priceCurrency = $priceCurrency;
        $this->flightId = $flightId;
        $this->userId = $userId;
        $this->luggageId = $luggageId;
        $this->luggageType = $luggageType;
        $this->luggageWeightNumber = $luggageWeightNumber;
        $this->luggageWeightUnit = $luggageWeightUnit;
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
            $body["seatNumber"],
            $body["seatLetter"],
            $body["seatClass"],
            $body["priceValue"],
            $body["priceCurrency"],
            $body["flightId"],
            $body["userId"],
            $body["luggageId"],
            $body["luggageType"],
            $body["luggageWeightNumber"],
            $body["luggageWeightUnit"],
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
            "seatNumber" => $this->seatNumber,
            "seatLetter" => $this->seatLetter,
            "seatClass" => $this->seatClass,
            "priceValue" => $this->priceValue,
            "priceCurrency" => $this->priceCurrency,
            "flightId" => $this->flightId,
            "userId" => $this->userId,
            "luggageId" => $this->luggageId,
            "luggageType" => $this->luggageType,
            "luggageWeightNumber" => $this->luggageWeightNumber,
            "luggageWeightUnit" => $this->luggageWeightUnit
        ];
    }
}