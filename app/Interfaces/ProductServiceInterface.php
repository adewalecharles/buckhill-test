<?php

namespace App\Interfaces;

interface ProductServiceInterface
{
    /**
     * Get all products in the system
     *
     *
     * @throws \Exception
     */
    public function getAllProducts(): array;

    /**
     * Create a new product record
     *
     *
     *
     * @throws \Exception
     */
    public function createProduct(array $valid): \Illuminate\Http\Resources\Json\JsonResource;

    /**
     * Get a single product using uuid
     *
     * @throws \Exception
     */
    public function getProduct(string $uuid): \Illuminate\Http\Resources\Json\JsonResource;

    /**
     * Update a Product record
     */
    public function updateProduct(array $valid, string $uuid): \Illuminate\Http\Resources\Json\JsonResource;

    /**
     * Delete a Product record
     */
    public function deleteProduct(string $uuid): bool;
}
