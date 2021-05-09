<?php


namespace CodelyTv\OpenFlight\Books\Domain;

interface BookRepository
{
    public function create(Book $book): void;
}