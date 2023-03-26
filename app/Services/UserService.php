<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * Get all users
     */
    public function getAllUsers(): array
    {
        return UserResource::collection($this->userRepository->getAllUsers())->response()->getData(true);
    }

    /**
     * Update User
     */
    public function updateUser(array $valid, string $uuid): \Illuminate\Http\Resources\Json\JsonResource
    {
        return new UserResource($this->userRepository->updateUser($valid, $uuid));
    }

    /**
     * Delete a user
     */
    public function deleteUser(string $uuid): bool|null
    {
        return $this->userRepository->deleteUser($uuid);
    }
}
