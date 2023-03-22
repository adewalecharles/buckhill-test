<?php
namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\AuthRepository;
use App\Repositories\UserRepository;
use Carbon\CarbonImmutable;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Token\Plain;

class AuthService
{
    /**
     * @var AuthRepository
     */
    protected $authRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Auth Service constructor
     *
     * @param AuthRepository $authRepository
     * @param UserRepository $userRepository
     */

    public function __construct(AuthRepository $authRepository, UserRepository $userRepository)
    {
        $this->authRepository = $authRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Method to register users
     *
     * @param array $valid
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function registerUser(array $valid)
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
                'user' => new UserResource($user)
            ];

        }

        throw new \Exception('Could not authenticate user');

    }

    /**
     * Login users
     *
     * @param array $valid
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function loginUser(array $valid)
    {
        $user = $this->userRepository->getUserByEmail($valid['email']);

        if (!$user) {
           throw new \Exception('User does not exists');
        }

        if (!$user->is_admin) {
            throw new \Exception('User is not an admin account');
        }

        //check password
        if (!$user || !Hash::check($valid['password'], $user->password)) {
            throw new \Exception("Invalid Credentials");
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
                'user' => new UserResource($user)
            ];
        }

        throw new \Exception('Invalid Credentials');

    }


    /**
     * Logout authenticated user
     *
     * @return bool
     */
    public function logoutUser():bool
    {
        $this->authRepository->deleteAuthToken(auth()->user());
        Auth::logout();
        return true;
    }


    /**
     * Function to generate new JWT token
     *
     * @param User $user
     *
     * @return Plain
     */
    private function generateAuthToken(User $user):Plain
    {
       return $user->setExpiresAt(CarbonImmutable::now()->addMinutes(120))
            ->setClaims([
                'user_uuid' => (string)$user->uuid,
                'unique_id' => \Illuminate\Support\Str::random(10),
            ])
            ->setSubject('auth-token')
            ->createToken();
    }

}
