<?php

declare(strict_types=1);


namespace CodelyTv\OpenFlight\Flights\Domain;


use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

final class FlightCreatedDomainEvent extends DomainEvent
{

    private string $origin;
    private string $destination;
    private int $flightHours;
    private int $priceValue;
    private string $priceCurrency;
    private string $departureDate;
    private string $aircraft;
    private string $airline;

    public function __construct(
        Uuid $id,
        string $origin,
        string $destination,
        int $flightHours,
        int $priceValue,
        string $priceCurrency,
        string $departureDate,
        string $aircraft,
        string $airline,
        string $eventId = null,
        string $occurredOn = null
    ) {
        $this->origin = $origin;
        $this->destination = $destination;
        $this->flightHours = $flightHours;
        $this->priceValue = $priceValue;
        $this->priceCurrency = $priceCurrency;
        $this->departureDate = $departureDate;
        $this->aircraft = $aircraft;
        $this->airline = $airline;
        parent::__construct($id->value(), $eventId, $occurredOn);
    }

    public
    static function fromPrimitives(
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
            $body["priceValue"],
            $body["priceCurrency"],
            $body["departureDate"],
            $body["aircraft"],
            $body["airline"],
            $eventId,
            $occurredOn,
        );
    }

    public
    static function eventName(): string
    {
        return "open_flight.v1.flight.created";
    }

    public
    function toPrimitives(): array
    {
        return [
            "origin" => $this->origin,
            "destination" => $this->destination,
            "flightHours" => $this->flightHours,
            "priceValue" => $this->priceValue,
            "priceCurrency" => $this->priceCurrency,
            "departureDate" => $this->departureDate,
            "aircraft" => $this->aircraft,
            "airline" => $this->airline
        ];
    }
}