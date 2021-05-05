<?php


namespace CodelyTv\OpenFlight\Books\Domain;


use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\SeatValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use DateTime;

class Book extends AggregateRoot
{

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

    public static function CreateBook(Uuid $id, DateTime $buyDate, SeatValueObject $seat, PriceValueObject $price, Uuid $flightId, Uuid $userId, Luggage $luggage): Book
    {
        self::validateBuyDate($buyDate);
        self::validateSeat($seat);
        self::validatePrice($price);
        self::validateFlightId($flightId);
        self::validateUserId($userId);
        self::validateLuggage($luggage);

        return new self($id, $buyDate, $seat, $price, $flightId, $userId, $luggage);
    }

}