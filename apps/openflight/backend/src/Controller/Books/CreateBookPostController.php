<?php

declare(strict_types=1);


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Books;

use CodelyTv\OpenFlight\Books\Application\CreateBookCommand;
use CodelyTv\Shared\Domain\DomainError;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateBookPostController extends ApiController
{

    public function __invoke(string $id, Request $request): JsonResponse
    {
        try {
            $this->dispatch(
                new CreateBookCommand(
                    $id,
                    $request->request->get('buy-date'),
                    intval($request->request->get('number-seat')),
                    $request->request->getAlpha('letter-seat'),
                    $request->request->getAlpha('class-seat'),
                    intval($request->request->get('value-price')),
                    $request->request->get('currency-price'),
                    $request->request->get('flight-id'),
                    $request->request->get('user-id'),
                    $request->request->getAlpha('luggage-type'),
                    intval($request->request->get('luggage-weight-number')),
                    $request->request->getAlpha('luggage-weight-unit')
                )
            );

            return new JsonResponse("OK", Response::HTTP_CREATED);
        } catch (DomainError $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    protected function exceptions(): array
    {
        return [];
    }

}