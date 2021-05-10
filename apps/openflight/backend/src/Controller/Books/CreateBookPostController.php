<?php

declare(strict_types=1);


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Books;


use CodelyTv\OpenFlight\Books\Application\BookCreation;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateBookPostController
{
    public function __construct(private BookCreation $bookCreation)
    {
    }

    public function __invoke(string $id, Request $request): JsonResponse
    {
        try {
            $this->bookCreation->__invoke(
                $id,
                $request->request->get('buy-date'),
                $request->request->get('number-seat'),
                $request->request->getAlpha('letter-seat'),
                $request->request->getAlpha('class-seat'),
                $request->request->get('valuePrice'),
                $request->request->getAlpha('currencyPrice'),
                $request->request->get('flightId'),
                $request->request->get('userId'),
                $request->request->getAlpha('luggageType'),
                $request->request->get('luggageWeightNumber'),
                $request->request->getAlpha('luggageWightUnit')
            );
            return new JsonResponse("OK", Response::HTTP_CREATED);
        } catch (DomainError $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

}