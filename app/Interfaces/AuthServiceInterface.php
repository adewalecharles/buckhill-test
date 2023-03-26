<?php

namespace App\Interfaces;

use App\Models\User;
use Lcobucci\JWT\Token\Plain;

interface AuthServiceInterface
{
    /**
     * Method to register users
     *
     *
     * @throws \Exception
     */
    public function registerUser(array $valid): array;

    /**
     * Login users
     *
     *
     * @throws \Exception
     */
    public function loginUser(array $valid): array;

    /**
     * Logout authenticated user
     */
    public function logoutUser(): bool;

    /**
     * Function to generate new JWT token
     */
    public function generateAuthToken(User $user): Plain;
}
