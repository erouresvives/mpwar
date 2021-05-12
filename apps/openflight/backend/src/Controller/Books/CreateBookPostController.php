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
                $request->request->get('value-price'),
                $request->request->get('currency-price'),
                $request->request->get('flight-id'),
                $request->request->get('user-id'),
                $request->request->getAlpha('luggage-type'),
                $request->request->get('luggage-weight-number'),
                $request->request->getAlpha('luggage-weight-unit')
            );
            return new JsonResponse("OK", Response::HTTP_CREATED);
        } catch (DomainError $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

}