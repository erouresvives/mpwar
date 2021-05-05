<?php

declare(strict_types=1);


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Books;



use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class BookFlightPostController
{
    public function __construct(private BookFlightCreation $bookFlightCreation)
    {
    }

    public function __invoke(string $id, Request $request): JsonResponse
    {
        try {
            $this->flightCreation->__invoke(
                $id,
                $request->request->getAlpha('origin'),
                $request->request->getAlpha('destination'),
                $request->request->get('flight-hours'),
                $request->request->get('price'),
                $request->request->get('currency'),
                $request->request->get('departure-date'),
                $request->request->getAlpha('aircraft'),
                $request->request->getAlpha('airline')
            );
            return new JsonResponse("OK", Response::HTTP_CREATED);
        } catch (DomainError $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

}