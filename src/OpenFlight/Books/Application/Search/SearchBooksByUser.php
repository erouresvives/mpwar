<?php


namespace CodelyTv\OpenFlight\Books\Application\Search;


use CodelyTv\OpenFlight\Books\Domain\BookRepository;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Shared\Domain\ValueObject\DateTimeValueObject;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

class SearchBooksByUser
{

    public function __construct(private BookRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(Uuid $userId): SearchBooksByUserResponse
    {
        $booksQueryResult = $this->repository->findBooksByUser($userId);

        $BooksResponses = [];
        foreach ($booksQueryResult as $book) {
            $BooksResponses [] = new BookResponse(
                DateTimeValueObject::convertDateTimeToString($book->getBuyDate()),
                $book->getSeat()->getNumber(),
                $book->getSeat()->getLetter(),
                $book->getSeat()->getClass(),
                $book->getPrice()->getValue(),
                $book->getPrice()->getCurrency(),
                $book->getFlightId(),
                $book->getUserId(),
                $book->getLuggage()->getType(),
                $book->getLuggage()->getWeight()->getNumber(),
                $book->getLuggage()->getWeight()->getUnit()
            );
        }

        return new SearchBooksByUserResponse($BooksResponses);
    }
}