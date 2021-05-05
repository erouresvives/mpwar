<?php


namespace CodelyTv\Shared\Domain\ValueObject;


class PriceValueObject
{
    private int $value;
    private string $currency;


    public function __construct(int $value, string $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }
}