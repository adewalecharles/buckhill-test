<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository
{
    /**
     * get a single user using user uuid
     *
     *
     * @return User
     */
    public function getUser(string $uuid): ?User
    {
        $user = User::where('uuid', $uuid)->first();

        if (! $user) {
            throw new ModelNotFoundException('User is not found', 404);
        }

        return $user;
    }

    /**
     * get a single user using user email
     *
     *
     * @return User
     */
    public function getUserByEmail(string $email): ?User
    {
        $user = User::where('email', $email)->first();
        if (! $user) {
            throw new ModelNotFoundException('User is not found', 404);
        }

        return $user;
    }

    /**
     * Get all users
     */
    public function getAllUsers(): mixed
    {
        return User::searchAndSort(
            request('q'), // search query
            request('sortBy'), // sort field
            request('desc'),
            request('limit'),// sort direction (boolean)
            20 // pagination limit
        );
    }

    /**
     * Creates a new record of a user
     *
     *
     * @return User
     */
    public function createUser(array $valid): ?User
    {
        return User::create($valid);
    }

    /**
     * Update a user record
     *
     *
     * @return User
     */
    public function updateUser(array $valid, string $uuid): ?User
    {
        $user = User::where('uuid', $uuid)->first();

        if ($user) {
            $user->update($valid);

            return $user;
        }

        throw new ModelNotFoundException('User is not found', 404);
    }

    /**
     * Delete User
     */
    public function deleteUser(string $uuid): bool
    {
        $user = User::where('uuid', $uuid)->first();

        if ($user) {
            $user->delete();

            return true;
        }

        throw new ModelNotFoundException('User is not found', 404);
    }
}
