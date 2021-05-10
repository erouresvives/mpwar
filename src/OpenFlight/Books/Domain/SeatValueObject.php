<?php


namespace CodelyTv\OpenFlight\Books\Domain;


class SeatValueObject
{

    const class_types = ['first', 'business'];

    private int $number;
    private string $letter;
    private string $class;


    public function __construct(int $number, string $letter, string $class)
    {
        $this->number = $number;
        $this->letter = $letter;
        $this->class = $class;
    }

    public static function createSeat(int $number, string $letter, string $class): SeatValueObject
    {
        self::validateNumber($number);
        self::validateLetter($letter);
        self::validateClass($class);
        return new self($number, $letter, $class);
    }

    private static function validateNumber(int $number)
    {
        if ($number <= 0 || $number === 13) {
            throw new InvalidSeatNumber();
        }
    }

    private static function validateLetter(string $letter)
    {
        if ($letter < 'A' || $letter > 'Z') {
            throw new InvalidSeatLetter();
        }
    }

    private static function validateClass(string $class)
    {
        if (!in_array($class, self::class_types)) {
            throw new InvalidSeatClass();
        }
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getLetter(): string
    {
        return $this->letter;
    }

    public function getClass(): string
    {
        return $this->class;
    }

}