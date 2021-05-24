<?php


namespace CodelyTv\OpenFlight\Books\Domain;

use CodelyTv\Shared\Domain\ValueObject\Uuid;

interface BookRepository
{
    public function save(Book $book): void;
    public function findBooksByUser(Uuid $userId) : array;
}