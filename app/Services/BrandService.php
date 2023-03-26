<?php

namespace App\Services;

use App\Http\Resources\BrandResource;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\BrandServiceInterface;

class BrandService implements BrandServiceInterface
{
    public function __construct(private BrandRepositoryInterface $brandRepository)
    {
    }

    /**
     * Get all brands
     */
    public function getAllBrands(): \Illuminate\Http\Resources\Json\JsonResource
    {
        return  BrandResource::collection($this->brandRepository->getAllBrands());
    }
}
