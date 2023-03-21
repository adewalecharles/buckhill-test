<?php
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{

    /**
     * Get all Categories
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */

     public function getAllCategories(): \Illuminate\Database\Eloquent\Collection
     {
        return Category::all();
     }
}
