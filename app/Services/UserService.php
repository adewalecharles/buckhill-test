<?php
namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all users
     *
     * @return array
     */
    public function getAllUsers():array
    {
        return UserResource::collection($this->userRepository->getAllUsers())->response()->getData(true);

    }

    /**
     * Update User
     *
     * @param array $valid
     * @param string $uuid
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function updateUser(array $valid, string $uuid): \Illuminate\Http\Resources\Json\JsonResource
    {
        $user = $this->userRepository->updateUser($valid, $uuid);

        if ($user) {
            return new UserResource($user);
        }

        throw new \Exception('User not Found');

    }

    /**
     * Delete a user
     *
     * @param string $uuid
     *
     * @return bool|null
     */
    public function deleteUser(string $uuid):bool|null
    {
        return $this->userRepository->deleteUser($uuid);
    }
}
