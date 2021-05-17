<?php


namespace CodelyTv\OpenFlight\Books\Domain;


use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;

class Book extends AggregateRoot
{

    private Uuid $id;
    private DateTimeValueObject $buyDate;
    private SeatValueObject $seat;
    private PriceValueObject $price;
    private Uuid $flightId;
    private Uuid $userId;
    private Luggage $luggage;

    public function __construct(
        Uuid $id,
        DateTimeValueObject $buyDate,
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
        DateTimeValueObject $buyDate,
        SeatValueObject $seat,
        PriceValueObject $price,
        Uuid $flightId,
        Uuid $userId,
        Luggage $luggage
    ): Book {
        self::validateBuyDate($buyDate);
        $book = new self($id, $buyDate, $seat, $price, $flightId, $userId, $luggage);

        $book->record(
            new BookCreatedDomainEvent(
                $id,
                DateTimeValueObject::convertDateTimeToString($book->getBuyDate()),
                $book->getSeat()->getNumber(),
                $book->getSeat()->getLetter(),
                $book->getSeat()->getClass(),
                $book->getPrice()->getValue(),
                $book->getPrice()->getCurrency(),
                $book->getFlightId()->value(),
                $book->getUserId()->value(),
                $book->getLuggage()->getId()->value(),
                $book->getLuggage()->getType(),
                $book->getLuggage()->getWeight()->getNumber(),
                $book->getLuggage()->getWeight()->getUnit()
            )
        );
        return $book;
    }

    private static function validateBuyDate(DateTimeValueObject $buyDate)
    {
        if ($buyDate === null) {
            throw new EmptyBuyDate();
        }

        if ($buyDate->isPastDate()) {
            throw new InvalidBuyDate();
        }
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getBuyDate(): DateTimeValueObject
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