<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * get a single user using user uuid
     *
     *
     * @return User
     */
    public function getUser(string $uuid): ?User;

    /**
     * get a single user using user email
     *
     *
     * @return User
     */
    public function getUserByEmail(string $email): ?User;

    /**
     * Get all users
     */
    public function getAllUsers(): mixed;

    /**
     * Creates a new record of a user
     *
     *
     * @return User
     */
    public function createUser(array $valid): ?User;

    /**
     * Update a user record
     *
     *
     * @return User
     */
    public function updateUser(array $valid, string $uuid): ?User;

    /**
     * Delete User
     */
    public function deleteUser(string $uuid): bool;
}
