<?php
declare(strict_types=1);


namespace CodelyTv\Apps\OpenFlight\Backend\Controller\Users;


use CodelyTv\OpenFlight\Users\Application\UserLogin;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class LoginPostController
{
    public function __construct(private UserLogin $userLogin)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->userLogin->__invoke(
                $request->request->getAlpha('username'),
                $request->request->get('password')
            );
            return new JsonResponse("OK", Response::HTTP_OK);
        } catch (DomainError $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

}