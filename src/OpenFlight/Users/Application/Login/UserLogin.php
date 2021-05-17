<?php


namespace CodelyTv\OpenFlight\Users\Application\Login;


use CodelyTv\OpenFlight\Users\Domain\UserRepository;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

class UserLogin
{

    public function __construct(private UserRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(string $username, string $password): LoginUserResponse
    {
        $user = $this->repository->findByUsername($username);
        $user->Login($password);
        $this->bus->publish(...$user->pullDomainEvents());

        return new LoginUserResponse($user->Username(), $user->Name(), $user->LastName());
    }
}