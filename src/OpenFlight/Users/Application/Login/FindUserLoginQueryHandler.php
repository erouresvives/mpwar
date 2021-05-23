<?php


namespace CodelyTv\OpenFlight\Users\Application\Login;


use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

class FindUserLoginQueryHandler implements QueryHandler
{
    public function __construct(private UserLogin $userLogin)
    {
    }

    public function __invoke(FindUserLoginQuery $query): LoginUserResponse
    {
        return $this->userLogin->__invoke($query->getUsername(), $query->getPassword());
    }
}