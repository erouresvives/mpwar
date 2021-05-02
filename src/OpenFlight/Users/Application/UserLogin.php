<?php


namespace CodelyTv\OpenFlight\Users\Application;


use CodelyTv\OpenFlight\Users\Domain\UserRepository;

class UserLogin
{

    /**
     * UserLogin constructor.
     * @param UserRepository $repository
     */
    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(string $username, string $password): void
    {
        $user = $this->repository->findByUsername($username);
        $user->checkPassword($password);
    }
}