<?php

namespace App\Repositories;

use App\Models\JwtToken;
use App\Models\User;
use Lcobucci\JWT\Token\Plain;

class AuthRepository
{
    /**
     * Create a record of JWT token for the given user
     *
     * @return JwtToken
     */
    public function createAuthToken(User $user, Plain $jwt): ?JwtToken
    {
        return JwtToken::updateOrCreate(
            ['user_id' => $user->id],
            [
                'token_title' => $jwt->headers()->get('sub'),
                'unique_id' => $jwt->claims()->get('unique_id'),
                'permissions' => null,
                'restrictions' => null,
                'last_used_at' => now(),
                'expires_at' => $jwt->claims()->get('exp'),
                'refreshed_at' => null,
            ]);
    }

    /**
     * Delete user token
     */
    public function deleteAuthToken(User $user): void
    {
        $user->jwtToken()->delete();
    }
}
