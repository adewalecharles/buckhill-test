<?php
namespace App\Repositories;

use App\Models\Brand;

class BrandRepository
{

    /**
     * Get all brands
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllBrands(): \Illuminate\Database\Eloquent\Collection
    {
        return Brand::all();
    }
}
