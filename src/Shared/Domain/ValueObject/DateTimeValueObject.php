<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\ValueObject;

use DateTime;

class DateTimeValueObject
{
    const today = "NOW";
    const dateFormat = 'Y-m-d H:i:s';

    public function __construct(protected DateTime $value)
    {
    }

    public function value(): DateTime
    {
        return $this->value;
    }

    public static function createDateTimeValueObjectFromString(string $date): DateTimeValueObject
    {
        $dateTime = new DateTime($date);
        return new self(DateTime::createFromFormat(self::dateFormat, $dateTime->format(self::dateFormat)));
    }

    public static function convertDateTimeToString(DateTimeValueObject $date): string
    {
        return $date->value()->format(self::dateFormat);
    }

    public function isPastDate(): bool
    {
        return $this->value < new DateTime(self::today);
    }
}
