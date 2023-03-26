<?php

namespace App\Repositories;

use App\Interfaces\BrandRepositoryInterface;
use App\Models\Brand;

class BrandRepository implements BrandRepositoryInterface
{
    /**
     * Get all brands
     */
    public function getAllBrands(): \Illuminate\Database\Eloquent\Collection
    {
        return Brand::all();
    }
}
