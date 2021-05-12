<?php


namespace CodelyTv\OpenFlight\Books\Domain;


use CodelyTv\Shared\Domain\ValueObject\Uuid;

class Luggage
{

    private Uuid $id;
    private string $type;
    private WeightValueObject $weight;
    private Uuid $bookId;

    public function __construct(Uuid $id, string $type, WeightValueObject $weight, Uuid $bookId)
    {
        $this->id = $id;
        $this->type = $type;
        $this->weight = $weight;
        $this->bookId = $bookId;
    }

    public static function createLuggage(Uuid $id, string $type, WeightValueObject $weight, Uuid $bookId): Luggage
    {
        self::validateType($type);

        return new self($id, $type, $weight, $bookId);
    }

    private static function validateType(string $type)
    {
        if ($type === "") {
            throw new InvalidLuggageType();
        }
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getWeight(): WeightValueObject
    {
        return $this->weight;
    }

    public function getBookId(): Uuid
    {
        return $this->bookId;
    }

}