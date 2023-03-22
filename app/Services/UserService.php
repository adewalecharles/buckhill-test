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
     * @param User $user
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function updateUser(array $valid, User $user): \Illuminate\Http\Resources\Json\JsonResource
    {
        return new UserResource($this->userRepository->updateUser($valid, $user));
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
