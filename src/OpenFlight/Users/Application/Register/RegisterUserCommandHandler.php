<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Users\Application\Register;

use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;
use CodelyTv\Shared\Domain\ValueObject\Uuid;

final class RegisterUserCommandHandler implements CommandHandler
{

    private UserRegistration $userRegistration;

    public function __construct(UserRegistration $userRegistration)
    {
        $this->userRegistration = $userRegistration;
    }

    public function __invoke(RegisterUserCommand $command): void
    {
        $id = new Uuid($command->getId());

        $this->userRegistration->__invoke(
            $id,
            $command->getUsername(),
            $command->getName(),
            $command->getLastName(),
            $command->getPassword()
        );
    }

}
