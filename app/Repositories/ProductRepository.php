<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Get all products, all params to search and sort and pulled directly from the request helper method
     */
    public function getAllProducts()
    {
        return Product::searchAndSort(
            request('q'), // search query
            request('sortBy'), // sort field
            request('desc'),
            request('limit'), // sort direction (boolean)
            20 // pagination limit
        );
    }

    /**
     * Create a new Product record
     *
     *
     * @return Product
     */
    public function createProduct(array $valid): ?Product
    {
        return Product::create($valid);
    }

    /**
     * Get a single Product using uuid
     *
     * @pram string $uuid
     *
     * @return Product
     */
    public function getProduct(string $uuid): ?Product
    {
        $product = Product::where('uuid', $uuid)->first();

        if (! $product) {
            throw new ModelNotFoundException('Product is not found', 404);
        }

        return $product;
    }

    /**
     * Update a Product record
     */
    public function updateProduct(array $valid, string $uuid): mixed
    {
        $product = Product::where('uuid', $uuid)->first();

        if ($product) {
            $product->update($valid);

            return $product;
        }

        throw new ModelNotFoundException('Product is not found', 404);
    }

    /**
     * Delete a Product record
     */
    public function deleteProduct(string $uuid): mixed
    {
        $product = Product::where('uuid', $uuid)->first();

        if ($product) {
            $product->delete();

            return true;
        }

        throw new ModelNotFoundException('Product is not found', 404);
    }
}
