<?php

declare(strict_types=1);


namespace CodelyTv\OpenFlight\Flights\Infrastructure;


use CodelyTv\OpenFlight\Flights\Domain\FlightCounter;
use CodelyTv\OpenFlight\Flights\Domain\FlightCounterRepository;
use CodelyTv\Shared\Infrastructure\Persistence\Mysql;


final class MysqlFlightCounterRepository implements FlightCounterRepository
{
    public function __construct(private Mysql $mysql)
    {
    }

    public function insert(FlightCounter $flightCounter): void
    {
        $sql = 'INSERT IGNORE INTO flightCounter (`Id`,`Destination`,`Total-trips`) VALUES (:id, :destination,:totalTrips)';

        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':id', $flightCounter->getId());
        $statement->bindValue(':destination', $flightCounter->getDestination());
        $statement->bindValue(':totalTrips', $flightCounter->getTotalTrips());
        $statement->execute();
    }

    public function update(string $destination): void
    {
        $sql = 'UPDATE flightCounter SET `Total-trips` = `Total-trips` + 1 WHERE `Destination` = :destination';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':destination', $destination);
        $statement->execute();
    }

    public function getDestinationCount(string $destination): int
    {
        $sql = 'SELECT `Total-trips` FROM flightCounter WHERE `Destination` = :destination LIMIT 1';
        $statement = $this->mysql->PDO()->prepare($sql);
        $statement->bindValue(':destination', $destination);

        $statement->execute();
        $flightCounterArr = $statement->fetchAll();

        if (empty($flightCounterArr)) {
            return 0;
        }

        return intval($flightCounterArr[0]["Total-trips"]);
    }

}