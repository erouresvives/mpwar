<?php

declare(strict_types=1);


namespace CodelyTv\OpenFlight\Flights\Domain;


use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use DateTime;

final class FlightCreatedDomainEvent extends DomainEvent
{

    private string $origin;
    private string $destination;
    private int $flightHours;
    private PriceValueObject $price;
    private DateTime $departureDate;
    private string $aircraft;
    private string $airline;

    public function __construct(
        Uuid $id,
        string $origin,
        string $destination,
        int $flightHours,
        PriceValueObject $price,
        DateTime $departureDate,
        string $aircraft,
        string $airline,
        string $eventId = null,
        string $occurredOn = null
    ) {
        $this->origin = $origin;
        $this->destination = $destination;
        $this->flightHours = $flightHours;
        $this->price = $price;
        $this->departureDate = $departureDate;
        $this->aircraft = $aircraft;
        $this->airline = $airline;
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
            $body["origin"],
            $body["destination"],
            $body["flightHours"],
            $body["price"],
            $body["departureDate"],
            $body["aircraft"],
            $body["airline"],
            $eventId,
            $occurredOn,
        );
    }

    public static function eventName(): string
    {
        return "open_flight.v1.flight.created";
    }

    public function toPrimitives(): array
    {
        return [
            "origin" => $this->origin,
            "destination" => $this->destination,
            "flightHours" => $this->flightHours,
            "price" => $this->price,
            "departureDate" => $this->departureDate,
            "aircraft" => $this->aircraft,
            "airline" => $this->airline
        ];
    }
}