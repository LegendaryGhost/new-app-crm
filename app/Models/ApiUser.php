<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;

class ApiUser implements Authenticatable
{

    protected int $id;
    protected string|null $name;
    protected string|null $email;
    protected string|null $role;

    public function __construct(array $attribs = [])
    {
        $this->id = $attribs["id"] ?? null;
        $this->name = $attribs["name"] ?? null;
        $this->email = $attribs["email"] ?? null;
        $this->role = $attribs["role"] ?? null;
    }

    public function getAuthIdentifierName()
    {
        return 'id'; // Nom de la clé d'identifiant unique
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPasswordName()
    {
        return null; // Pas besoin du mot de passe puisque l'authentification est déléguée
    }

    public function getAuthPassword()
    {
        return null; // Si tu n'utilises pas le remember_token
    }

    public function getRememberToken()
    {
        return null; // Si tu n'utilises pas le remember_token
    }

    public function setRememberToken($value)
    {
        // Pas nécessaire dans ce cas
    }

    public function getRememberTokenName()
    {
        return null; // Pas de remember_token
    }
}
