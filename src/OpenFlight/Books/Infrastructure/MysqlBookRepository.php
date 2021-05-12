<?php

declare(strict_types=1);


namespace CodelyTv\OpenFlight\Books\Infrastructure;


use CodelyTv\OpenFlight\Books\Domain\Book;
use CodelyTv\OpenFlight\Books\Domain\BookRepository;
use CodelyTv\Shared\Infrastructure\Persistence\Mysql;


final class MysqlBookRepository implements BookRepository
{
    public function __construct(private Mysql $mysql)
    {
    }

    public function save(Book $book): void
    {
        $sql = 'INSERT INTO book VALUES(:id, :buyDate, :numberSeat, :letterSeat, :classSeat, :priceValue, :priceCurrency, :flightId, :userId)';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':id', $book->getId()->value());
        $statement->bindValue(':buyDate', Book::convertBuyDateToString($book->getBuyDate()));
        $statement->bindValue(':numberSeat', $book->getSeat()->getNumber());
        $statement->bindValue(':letterSeat', $book->getSeat()->getLetter());
        $statement->bindValue(':classSeat', $book->getSeat()->getClass());
        $statement->bindValue(':priceValue', $book->getPrice()->getValue());
        $statement->bindValue(':priceCurrency', $book->getPrice()->getCurrency());
        $statement->bindValue(':flightId', $book->getFlightId()->value());
        $statement->bindValue(':userId', $book->getUserId()->value());

        $sqlLuggage = 'INSERT INTO luggage VALUES(:id, :type, :weightValue, :weightUnit, :bookId)';
        $statementLuggage = $this->mysql->PDO()->prepare($sqlLuggage);
        $statementLuggage->bindValue(':id', $book->getLuggage()->getId()->value());
        $statementLuggage->bindValue(':type', $book->getLuggage()->getType());
        $statementLuggage->bindValue(':weightValue', $book->getLuggage()->getWeight()->getNumber());
        $statementLuggage->bindValue(':weightUnit', $book->getLuggage()->getWeight()->getUnit());
        $statementLuggage->bindValue(':bookId', $book->getLuggage()->getBookId()->value());

        $statement->execute();
        $statementLuggage->execute();
    }

}