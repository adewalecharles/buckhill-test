<?php

namespace App\Interfaces;

use App\Models\JwtToken;
use App\Models\User;
use Lcobucci\JWT\Token\Plain;

interface AuthRepositoryInterface
{
    /**
     * Create a record of JWT token for the given user
     *
     * @return JwtToken
     */
    public function createAuthToken(User $user, Plain $jwt): ?JwtToken;

    /**
     * Delete user token
     */
    public function deleteAuthToken(User $user): void;
}
