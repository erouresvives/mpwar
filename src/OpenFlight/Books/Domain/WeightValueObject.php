<?php


namespace CodelyTv\OpenFlight\Books\Domain;


class WeightValueObject
{
    const unit_types = ['kg', 'lbs'];

    private int $number;
    private string $unit;


    public function __construct(int $number, string $unit)
    {
        $this->number = $number;
        $this->unit = $unit;
    }

    public static function createWeight(int $number, string $unit): WeightValueObject
    {
        self::validateNumber($number);
        self::validateUnit($unit);

        return new self($number, $unit);
    }

    private static function validateNumber(int $number)
    {
        if ($number < 0) {
            throw new InvalidWeightNumber();
        }
    }

    private static function validateUnit(string $unit)
    {
        if (!in_array($unit, self::unit_types)) {
            throw new InvalidWeightUnit();
        }
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }


}