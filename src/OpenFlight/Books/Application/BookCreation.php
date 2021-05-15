<?php


namespace CodelyTv\OpenFlight\Books\Application;


use CodelyTv\OpenFlight\Books\Domain\Book;
use CodelyTv\OpenFlight\Books\Domain\BookRepository;
use CodelyTv\OpenFlight\Books\Domain\Luggage;
use CodelyTv\OpenFlight\Books\Domain\SeatValueObject;
use CodelyTv\OpenFlight\Books\Domain\WeightValueObject;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;


class BookCreation
{

    public function __construct(private BookRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(
        string $id,
        string $buyDate,
        string $numberSeat,
        string $letterSeat,
        string $classSeat,
        string $valuePrice,
        string $currencyPrice,
        string $flightId,
        string $userId,
        string $luggageType,
        string $luggageWeightNumber,
        string $luggageWightUnit
    ): void {
        $bookUuId = new Uuid($id);
        $flightUuId = new Uuid($flightId);
        $userUuId = new Uuid($userId);

        $book = Book::CreateBook(
            $bookUuId,
            DateTimeValueObject::createDateTimeValueObjectFromString($buyDate),
            SeatValueObject::createSeat(intval($numberSeat), $letterSeat, $classSeat),
            PriceValueObject::createPrice(intval($valuePrice), $currencyPrice),
            $flightUuId,
            $userUuId,
            Luggage::createLuggage(
                Uuid::random(),
                $luggageType,
                WeightValueObject::createWeight(intval($luggageWeightNumber), $luggageWightUnit),
                $bookUuId
            )
        );

        $this->repository->save($book);
        $this->bus->publish(...$book->pullDomainEvents());
    }

}