<?php


namespace CodelyTv\OpenFlight\Books\Domain;

interface BookRepository
{
    public function save(Book $book): void;
}