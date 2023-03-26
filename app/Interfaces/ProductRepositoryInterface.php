<?php

namespace App\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{
    /**
     * Get all products, all params to search and sort and pulled directly from the request helper method
     */
    public function getAllProducts();

    /**
     * Create a new Product record
     *
     *
     * @return Product
     */
    public function createProduct(array $valid): ?Product;

    /**
     * Get a single Product using uuid
     *
     * @pram string $uuid
     *
     * @return Product
     */
    public function getProduct(string $uuid): ?Product;

    /**
     * Update a Product record
     */
    public function updateProduct(array $valid, string $uuid): mixed;

    /**
     * Delete a Product record
     */
    public function deleteProduct(string $uuid): mixed;
}
