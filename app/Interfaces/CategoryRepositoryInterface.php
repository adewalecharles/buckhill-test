<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    /**
     * Get all Categories
     */
    public function getAllCategories(): \Illuminate\Database\Eloquent\Collection;
}
