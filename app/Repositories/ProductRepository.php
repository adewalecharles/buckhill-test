<?php
namespace App\Repositories;

use App\Models\Product;
use App\Models\User;

class ProductRepository
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
     * @param array $valid
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
        return Product::where('uuid', $uuid)->first();
    }

    /**
     * Update a Product record
     *
     * @param array $valid
     *
     * @param string $uuid
     *
     * @return mixed
     */
    public function updateProduct(array $valid, string $uuid): mixed
    {
        $product = Product::where('uuid', $uuid)->first();

        if ($product) {
           $product->update($valid);
           return $product;
        }
        return false;
    }

    /**
     * Delete a Product record
     *
     * @param string $uuid
     *
     * @return mixed
     */
    public function deleteProduct(string $uuid): mixed
    {
        $product =  Product::where('uuid', $uuid)->first();

        if ($product) {
            $product->delete();
            return $product;
        }

        return false;

    }

}
