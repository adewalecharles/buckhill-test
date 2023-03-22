<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    /**
     * get a single user using user uuid
     *
     * @param string $uuid
     *
     * @return User
     */
    public function getUser(string $uuid): ?User
    {
        return User::where('uuid', $uuid)->first();
    }

    /**
     * get a single user using user email
     *
     * @param string $email
     *
     * @return User
     */
    public function getUserByEmail(string $email):?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * Get all users
     *
     * @return mixed
     */
    public function getAllUsers():mixed
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
     * @param array $valid
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
     * @param array $valid
     * @param User $user
     *
     * @return User
     */
    public function updateUser(array $valid, User $user): ?User
    {
         $user->update($valid);

         return $user;
    }

    /**
     * Delete User
     *
     * @param string $uuid
     *
     * @return bool
     */
    public function deleteUser(string $uuid):bool
    {
        $user = User::where('uuid', $uuid)->first();

        if ($user) {
             $user->delete();
             return true;
        }

        return false;
    }
}
