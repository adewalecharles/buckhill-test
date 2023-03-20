<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * @var User
     */
    protected $user;

    /**
     * Auth Repository constructor
     *
     * @param User $user
     */

    public function __constructor(User $user)
    {
        $this->user = $user;
    }

    /**
     * get a single user using user uuid
     *
     * @param Uuid $uuid
     *
     * @return User
     */
    public function getUser(string $uuid): User
    {
        return User::where('uuid', $uuid)->first();
    }

    /**
     * Get all users
     *
     * @return
     */
    public function getAllUsers()
    {
        return User::where('is_admin', false)->paginate(20);
    }

    /**
     * Creates a new record of a user
     *
     * @param array $valid
     *
     * @return User
     */
    public function createUser(array $valid):User
    {
        return User::create($valid);
    }
}
