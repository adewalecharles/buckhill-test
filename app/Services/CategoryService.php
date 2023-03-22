<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepository;

class CategoryService
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get all categories
     */
    public function getAllCategories(): \Illuminate\Http\Resources\Json\JsonResource
    {
        return CategoryResource::collection($this->categoryRepository->getAllCategories());
    }
}
