<?php

namespace App\Services;

use App\Exceptions\InvalidUserException;
use App\Http\Resources\UserResource;
use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\AuthServiceInterface;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\CarbonImmutable;
use Hash;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Token\Plain;

class AuthService implements AuthServiceInterface
{
    /**
     * Auth Service constructor
     */
    public function __construct(private AuthRepositoryInterface $authRepository, private UserRepository $userRepository)
    {
    }

    /**
     * Method to register users
     *
     *
     * @throws \Exception
     */
    public function registerUser(array $valid): array
    {
        $valid['last_login_at'] = now();
        $valid['is_admin'] = true;

        $user = $this->userRepository->createUser($valid);

        // log user in
        Auth::login($user);

        if (Auth::check()) {
            // create jwt token
            $jwt = $this->generateAuthToken($user);

            // store token in the db
            $token = $this->authRepository->createAuthToken($user, $jwt);

            return [
                'token' => $jwt->toString(),
                'type' => 'Bearer',
                'expires' => $token->expires_at,
                'user' => new UserResource($user),
            ];
        }

        throw new \Exception('Could not authenticate user');
    }

    /**
     * Login users
     *
     *
     * @throws \Exception
     */
    public function loginUser(array $valid): array
    {
        $user = $this->userRepository->getUserByEmail($valid['email']);

        if (! $user->is_admin) {
            throw new InvalidUserException('You do not have the permission to access this resource', 403);
        }
        //check password
        if (! $user || ! Hash::check($valid['password'], $user->password)) {
            throw new \Exception('Invalid Credentials', 400);
        }

        // log user in
        Auth::loginUsingId($user->id);

        if (Auth::check()) {
            // create jwt token
            $jwt = $this->generateAuthToken($user);

            // store token in the db
            $token = $this->authRepository->createAuthToken($user, $jwt);

            $user->last_login_at = now();
            $user->save();

            return [
                'token' => $jwt->toString(),
                'type' => 'Bearer',
                'expires' => $token->expires_at,
                'user' => new UserResource($user),
            ];
        }

        throw new \Exception('Could not Authenticate User', 401);
    }

    /**
     * Logout authenticated user
     */
    public function logoutUser(): bool
    {
        $this->authRepository->deleteAuthToken(auth()->user());
        Auth::logout();

        return true;
    }

    /**
     * Function to generate new JWT token
     */
    public function generateAuthToken(User $user): Plain
    {
        return $user->setExpiresAt(CarbonImmutable::now()->addMinutes(120))
             ->setClaims([
                 'user_uuid' => (string) $user->uuid,
                 'unique_id' => \Illuminate\Support\Str::random(10),
             ])
             ->setSubject('auth-token')
             ->createToken();
    }
}
