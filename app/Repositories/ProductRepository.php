<?php
namespace App\Repositories;

use App\Models\Product;

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
    public function createProduct(array $valid): Product
    {
        return Product::create($valid);
    }

}
