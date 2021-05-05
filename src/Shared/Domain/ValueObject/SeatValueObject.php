<?php


namespace CodelyTv\Shared\Domain\ValueObject;


class Seat
{
    private int $number;
    private string $letter;
    private string $class;


    public function __construct(int $number, string $letter, string $class)
    {
        $this->number = $number;
        $this->letter = $letter;
        $this->class = $class;
    }
}