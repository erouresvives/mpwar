<?php


namespace CodelyTv\OpenFlight\Flights\Domain;

use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use DateTime;

class Flight extends AggregateRoot
{
    const departureDateFormat = 'Y-m-d H:i:s';

    private Uuid $id;
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
        string $airline
    ) {
        $this->id = $id;
        $this->origin = $origin;
        $this->destination = $destination;
        $this->flightHours = $flightHours;
        $this->price = $price;
        $this->departureDate = $departureDate;
        $this->aircraft = $aircraft;
        $this->airline = $airline;
    }

    public static function CreateFlight(
        Uuid $id,
        string $origin,
        string $destination,
        int $flightHours,
        PriceValueObject $price,
        DateTime $departureDate,
        string $aircraft,
        string $airline
    ): Flight {
        self::validateOrigin($origin);
        self::validateDestination($destination);
        self::validateDifferentOriginDestination($origin, $destination);
        self::validateFlightHours($flightHours);
        self::validateDepartureDate($departureDate);
        self::validateAircraft($aircraft);
        self::validateAirline($airline);

        return new self(
            $id, $origin, $destination, $flightHours, $price, $departureDate, $aircraft, $airline
        );
    }

    public static function convertDepartureDateToDatetime(string $departureDate): DateTime {
        return DateTime::createFromFormat(self::departureDateFormat, $departureDate);
    }

    public static function convertDepartureDateToString(DateTime $departureDate): string {
        return $departureDate->format(self::departureDateFormat);
    }

    private static function validateOrigin(string $origin): void
    {
        if ($origin === "") {
            throw new EmptyOrigin();
        }
    }

    private static function validateDestination(string $destination): void
    {
        if ($destination === "") {
            throw new EmptyDestination();
        }
    }

    private static function validateDifferentOriginDestination(string $origin, string $destination): void
    {
        if ($origin === $destination) {
            throw new SameOriginDestination();
        }
    }

    private static function validateFlightHours(int $flightHours): void
    {
        if ($flightHours < 1) {
            throw new InvalidFlightHours();
        }
    }

    private static function validateDepartureDate(DateTime $departureDate): void
    {
        if ($departureDate === null) {
            throw new EmptyDepartureDate();
        }

        if ($departureDate < new DateTime('NOW')) {
            throw new InvalidDepartureDate();
        }
    }

    private static function validateAircraft(string $aircraft): void
    {
        if ($aircraft === "") {
            throw new EmptyAircraft();
        }
    }

    private static function validateAirline(string $airline): void
    {
        if ($airline === "") {
            throw new EmptyAirline();
        }
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getOrigin(): string
    {
        return $this->origin;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getFlightHours(): int
    {
        return $this->flightHours;
    }

    public function getPrice(): PriceValueObject
    {
        return $this->price;
    }

    public function getDepartureDate(): DateTime
    {
        return $this->departureDate;
    }

    public function getAircraft(): string
    {
        return $this->aircraft;
    }

    public function getAirline(): string
    {
        return $this->airline;
    }

}