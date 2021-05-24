<?php

declare(strict_types=1);


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Books;

use CodelyTv\OpenFlight\Books\Application\Search\SearchBooksByUserQuery;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class SearchBooksByUserGetController extends ApiController
{

    public function __invoke(string $id): JsonResponse
    {
        $response = $this->ask(
            new SearchBooksByUserQuery($id)
        );

        $searchBooksByUserResponse = [];
        foreach ($response->getBooks() as $book) {
            $searchBooksByUserResponse [] = [
                'buyDate' => $book->getBuyDate(),
                'seatNumber' => $book->getSeatNumber(),
                'seatLetter' => $book->getSeatLetter(),
                'seatClass' => $book->getSeatClass(),
                'price' => $book->getPriceValue(),
                'currency' => $book->getPriceCurrency(),
                'flightId' => $book->getFlightId(),
                'luggageType' => $book->getLuggageType(),
                'luggageWeight' => $book->getLuggageWeightNumber(),
                'luggageUnit' => $book->getLuggageWeightUnit()
            ];
        }

        return new JsonResponse(
            $searchBooksByUserResponse,
            Response::HTTP_OK
        );
    }

    protected function exceptions(): array
    {
        return [];
    }

}