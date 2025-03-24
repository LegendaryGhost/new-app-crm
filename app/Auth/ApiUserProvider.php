<?php

namespace App\Auth;

use App\Models\ApiUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class ApiUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        return new ApiUser(['id' => $identifier]);
    }

    public function retrieveByToken($identifier, #[\SensitiveParameter] $token)
    {
        return null; // Non utilisé
    }

    public function updateRememberToken(Authenticatable $user, #[\SensitiveParameter] $token)
    {
        // Non utilisé
    }

    public function retrieveByCredentials(#[\SensitiveParameter] array $credentials)
    {
        return null; // L'authentification se fait par API
    }

    public function validateCredentials(Authenticatable $user, #[\SensitiveParameter] array $credentials)
    {
        // TODO: Implement validateCredentials() method.
    }

    public function rehashPasswordIfRequired(Authenticatable $user, #[\SensitiveParameter] array $credentials, bool $force = false)
    {
        return false; // L'API gère cela
    }
}
