<?php


namespace CodelyTv\Shared\Domain\ValueObject;


class PriceValueObject
{
    const currency_types = ['$', '£', '€'];

    private int $value;
    private string $currency;


    public function __construct(int $value, string $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    public static function createPrice(int $value, string $currency): PriceValueObject
    {
        self::validateValue($value);
        self::validateCurrency($currency);
        return new self($value, $currency);
    }

    private static function validateValue(int $value): void
    {
        if ($value < 0) {
            throw new InvalidPrice();
        }
    }

    private static function validateCurrency(string $currency): void
    {
        if (!in_array($currency, self::currency_types)) {
            throw new InvalidCurrency();
        }
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

}