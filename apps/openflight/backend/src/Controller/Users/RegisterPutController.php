<?php

declare(strict_types=1);


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Users;


use CodelyTv\OpenFlight\Users\Application\Register\RegisterUserCommand;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class RegisterPutController extends ApiController
{

    public function __invoke(string $id, Request $request): JsonResponse
    {
        $this->dispatch(
            new RegisterUserCommand(
                $id,
                $request->request->getAlpha('username'),
                $request->request->getAlpha('name'),
                $request->request->getAlpha('last_name'),
                $request->request->get('password')
            )
        );

        return new JsonResponse("OK", Response::HTTP_CREATED);
    }

    protected function exceptions(): array
    {
        return [];
    }

}