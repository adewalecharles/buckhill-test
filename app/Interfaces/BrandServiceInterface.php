<?php

namespace App\Interfaces;

interface BrandServiceInterface
{
    /**
     * Get all brands
     */
    public function getAllBrands(): \Illuminate\Http\Resources\Json\JsonResource;
}
