<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    /**
     * Get all Categories
     */
    public function getAllCategories(): \Illuminate\Database\Eloquent\Collection
    {
        return Category::all();
    }
}
