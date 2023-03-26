<?php

namespace App\Interfaces;

interface CategoryServiceInterface
{
    /**
     * Get all categories
     */
    public function getAllCategories(): \Illuminate\Http\Resources\Json\JsonResource;
}
