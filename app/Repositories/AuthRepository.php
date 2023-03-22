<?php
namespace App\Repositories;

use App\Models\JwtToken;
use App\Models\User;
use DateTimeImmutable;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Token\Plain;

class AuthRepository
{
    /**
     * Create a record of JWT token for the given user
     * @param User $user
     * @param Plain $jwt
     *
     * @return JwtToken
     */
     public function createAuthToken(User $user, Plain $jwt):?JwtToken
     {

       return JwtToken::updateOrCreate(
        ['user_id' => $user->id],
        [
            'token_title' => $jwt->headers()->get('sub'),
            'unique_id' => $jwt->claims()->get('unique_id'),
            'permissions' => NULL,
            'restrictions' => NULL,
            'last_used_at' => now(),
            'expires_at' => $jwt->claims()->get('exp'),
            'refreshed_at' => NULL
        ]);

     }

     /**
      * Delete user token
      */
     public function deleteAuthToken(User $user):void
     {
         $user->jwtToken()->delete();
     }
}
