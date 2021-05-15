<?php


namespace CodelyTv\OpenFlight\Users\Application;


use CodelyTv\OpenFlight\Users\Domain\UserRepository;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

class UserLogin
{

    /**
     * UserLogin constructor.
     * @param UserRepository $repository
     */
    public function __construct(private UserRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(string $username, string $password): void
    {
        $user = $this->repository->findByUsername($username);
        $user->Login($password);
        $this->bus->publish(...$user->pullDomainEvents());
    }
}