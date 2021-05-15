<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Users\Application\Login;

use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class LoginUserCommandHandler implements CommandHandler
{

    private UserLogin $userLogin;

    public function __construct(UserLogin $userLogin)
    {
        $this->userLogin = $userLogin;
    }

    public function __invoke(LoginUserCommand $command): void
    {
        $this->userLogin->__invoke(
            $command->getUsername(),
            $command->getPassword()
        );
    }

}
