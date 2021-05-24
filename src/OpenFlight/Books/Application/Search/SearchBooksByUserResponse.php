<?php


namespace CodelyTv\OpenFlight\Books\Application\Search;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class SearchBooksByUserResponse implements Response
{
    private array $books;

    public function __construct($books)
    {
        $this->books = $books;
    }

    public function getBooks(): array
    {
        return $this->books;
    }


}