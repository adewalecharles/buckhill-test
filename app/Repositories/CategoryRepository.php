<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Get all Categories
     */
    public function getAllCategories(): \Illuminate\Database\Eloquent\Collection
    {
        return Category::all();
    }
}
