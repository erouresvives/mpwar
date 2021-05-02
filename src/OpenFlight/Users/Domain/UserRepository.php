<?php


namespace CodelyTv\OpenFlight\Users\Domain;

interface UserRepository
{
    public function Save(User $user): void;

    public function findByUsername(string $username): User;
}