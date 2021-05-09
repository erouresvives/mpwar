<?php


namespace CodelyTv\OpenFlight\Books\Domain;


use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use DateTime;

class Book extends AggregateRoot
{

    const buyDateFormat = 'Y-m-d H:i:s';

    private Uuid $id;
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
        Luggage $luggage
    ) {
        $this->id = $id;
        $this->buyDate = $buyDate;
        $this->seat = $seat;
        $this->price = $price;
        $this->flightId = $flightId;
        $this->userId = $userId;
        $this->luggage = $luggage;
    }

    public static function CreateBook(
        Uuid $id,
        DateTime $buyDate,
        SeatValueObject $seat,
        PriceValueObject $price,
        Uuid $flightId,
        Uuid $userId,
        Luggage $luggage
    ): Book {
        self::validateBuyDate($buyDate);
        self::validateFlightId($flightId);
        self::validateUserId($userId);

        return new self($id, $buyDate, $seat, $price, $flightId, $userId, $luggage);
    }

    private static function validateBuyDate(DateTime $buyDate)
    {
        if ($buyDate === null) {
            throw new EmptyBuyDate();
        }

        if ($buyDate < new DateTime('NOW')) {
            throw new InvalidLuggageType();
        }
    }

    private static function validateFlightId(Uuid $flightId)
    {
        if ($flightId === null) {
            throw new EmptyFlight();
        }
    }

    private static function validateUserId(Uuid $userId)
    {
        if ($userId === null) {
            throw new EmptyBook();
        }
    }


    public static function convertBuyDateToDatetime(string $buyDate): DateTime
    {
        return DateTime::createFromFormat(self::buyDateFormat, $buyDate);
    }

    public static function convertBuyDateToString(DateTime $buyDate): string
    {
        return $buyDate->format(self::buyDateFormat);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getBuyDate(): DateTime
    {
        return $this->buyDate;
    }

    public function getSeat(): SeatValueObject
    {
        return $this->seat;
    }

    public function getPrice(): PriceValueObject
    {
        return $this->price;
    }

    public function getFlightId(): Uuid
    {
        return $this->flightId;
    }

    public function getUserId(): Uuid
    {
        return $this->userId;
    }

    public function getLuggage(): Luggage
    {
        return $this->luggage;
    }


}