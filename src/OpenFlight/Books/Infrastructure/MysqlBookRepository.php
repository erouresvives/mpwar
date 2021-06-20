<?php

declare(strict_types=1);


namespace CodelyTv\OpenFlight\Books\Infrastructure;


use CodelyTv\OpenFlight\Books\Domain\Book;
use CodelyTv\OpenFlight\Books\Domain\BookRepository;
use CodelyTv\OpenFlight\Books\Domain\Luggage;
use CodelyTv\OpenFlight\Books\Domain\SeatValueObject;
use CodelyTv\OpenFlight\Books\Domain\WeightValueObject;
use CodelyTv\OpenFlight\Flights\Domain\Flight;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;
use CodelyTv\Shared\Domain\ValueObject\PriceValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Infrastructure\Persistence\Mysql;


final class MysqlBookRepository implements BookRepository
{
    public function __construct(private Mysql $mysql)
    {
    }

    public function save(Book $book): void
    {
        $sql = 'INSERT IGNORE INTO book VALUES(:id, :buyDate, :numberSeat, :letterSeat, :classSeat, :priceValue, :priceCurrency, :flightId, :userId)';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':id', $book->getId()->value());
        $statement->bindValue(':buyDate', DateTimeValueObject::convertDateTimeToString($book->getBuyDate()));
        $statement->bindValue(':numberSeat', $book->getSeat()->getNumber());
        $statement->bindValue(':letterSeat', $book->getSeat()->getLetter());
        $statement->bindValue(':classSeat', $book->getSeat()->getClass());
        $statement->bindValue(':priceValue', $book->getPrice()->getValue());
        $statement->bindValue(':priceCurrency', $book->getPrice()->getCurrency());
        $statement->bindValue(':flightId', $book->getFlightId()->value());
        $statement->bindValue(':userId', $book->getUserId()->value());

        $sqlLuggage = 'INSERT IGNORE INTO luggage VALUES(:id, :type, :weightValue, :weightUnit, :bookId)';
        $statementLuggage = $this->mysql->PDO()->prepare($sqlLuggage);
        $statementLuggage->bindValue(':id', $book->getLuggage()->getId()->value());
        $statementLuggage->bindValue(':type', $book->getLuggage()->getType());
        $statementLuggage->bindValue(':weightValue', $book->getLuggage()->getWeight()->getNumber());
        $statementLuggage->bindValue(':weightUnit', $book->getLuggage()->getWeight()->getUnit());
        $statementLuggage->bindValue(':bookId', $book->getLuggage()->getBookId()->value());

        $statement->execute();
        $statementLuggage->execute();
    }


    public function findBooksByUser(Uuid $userId): array
    {
        $sql = 'SELECT * FROM book WHERE `User-id` = :userId';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':userId', $userId);

        $statement->execute();
        $books = $statement->fetchAll();

        $foundBooks = [];

        foreach ($books as $book) {
            $uuid = new Uuid($book["Id"]);

            $bookObject = new Book(
                $uuid,
                DateTimeValueObject::createDateTimeValueObjectFromString($book["Buy-date"]),
                SeatValueObject::createSeat(intval($book["Number-seat"]), $book["Letter-seat"], $book["Class-seat"]),
                PriceValueObject::createPrice(intval($book["Price"]), $book["Currency"]),
                new Uuid($book["Flight-id"]),
                new Uuid($book["User-id"]),
                self::findBookLuggage($uuid)
            );

            $foundBooks [] = $bookObject;
        }

        return $foundBooks;
    }

    public function findBookLuggage(Uuid $bookId): Luggage
    {
        $sql = 'SELECT * FROM luggage WHERE `book-id` = :bookId LIMIT 1';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':bookId', $bookId);

        $statement->execute();
        $bookLuggageArr = $statement->fetchAll();

        $bookLuggage = $bookLuggageArr[0];

        return new Luggage(
            new Uuid($bookLuggage["Id"]),
            $bookLuggage["Type"],
            WeightValueObject::createWeight(intval($bookLuggage["Weight-value"]), $bookLuggage["Weight-unit"]),
            $bookId
        );
    }

}