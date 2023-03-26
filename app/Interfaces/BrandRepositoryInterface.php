<?php

namespace App\Interfaces;

interface BrandRepositoryInterface
{
    /**
     * Get all brands
     */
    public function getAllBrands(): \Illuminate\Database\Eloquent\Collection;
}
