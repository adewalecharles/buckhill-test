<?php
namespace App\Services;

use App\Http\Resources\BrandResource;
use App\Repositories\BrandRepository;

class BrandService
{
    /**
     * @var BrandRepository
     */
    protected $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }


    /**
     * Get all brands
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */

    public function getAllBrands(): \Illuminate\Http\Resources\Json\JsonResource
    {
        return  BrandResource::collection($this->brandRepository->getAllBrands());
    }
}
