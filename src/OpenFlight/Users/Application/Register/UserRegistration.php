<?php


namespace CodelyTv\OpenFlight\Users\Application\Register;

use CodelyTv\OpenFlight\Users\Domain\User;
use CodelyTv\OpenFlight\Users\Domain\UserRepository;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

class UserRegistration
{

    public function __construct(private UserRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(Uuid $id, string $username, string $name, string $lastname, string $password): void
    {
        $user = User::RegisterUser($id, $username, $name, $lastname, $password);
        $this->repository->Save($user);
        $this->bus->publish(...$user->pullDomainEvents());
    }
}