<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\ValueObject;

use DateTime;

class DateTimeValueObject
{
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
        return new self(DateTime::createFromFormat(self::dateFormat, $date));
    }

    public static function convertDateTimeToString(DateTimeValueObject $date): string
    {
        return $date->value()->format(self::dateFormat);
    }
}
