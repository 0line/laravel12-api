<?php

namespace Src\Auth\Domain;

use Illuminate\Auth\AuthenticationException;

interface AuthInterface
{
    /**
     * @throws AuthenticationException
     */
    public function login(array $credentials): string;
    /**
     * @throws AuthenticationException
     */
    public function refresh(): string;

    public function logout(): void;
}
