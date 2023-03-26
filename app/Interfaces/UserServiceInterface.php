<?php

namespace App\Interfaces;

interface UserServiceInterface
{
    /**
     * Get all users
     */
    public function getAllUsers(): array;

    /**
     * Update User
     */
    public function updateUser(array $valid, string $uuid): \Illuminate\Http\Resources\Json\JsonResource;

    /**
     * Delete a user
     */
    public function deleteUser(string $uuid): bool|null;
}
