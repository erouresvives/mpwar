<?php

declare(strict_types=1);


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Users;


use CodelyTv\OpenFlight\Users\Application\Login\FindUserLoginQuery;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class LoginPostController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        $response = $this->ask(
            new FindUserLoginQuery(
                $request->request->getAlpha('username'),
                $request->request->get('password')
            )
        );

        return new JsonResponse(
            [
                'username' => $response->getUsername(),
                'name' => $response->getName(),
                'last-name' => $response->getLastName(),
            ],
            Response::HTTP_OK
        );
    }

    protected function exceptions(): array
    {
        return [];
    }
}