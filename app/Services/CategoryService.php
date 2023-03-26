<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    {
    }

    /**
     * Get all categories
     */
    public function getAllCategories(): \Illuminate\Http\Resources\Json\JsonResource
    {
        return CategoryResource::collection($this->categoryRepository->getAllCategories());
    }
}
