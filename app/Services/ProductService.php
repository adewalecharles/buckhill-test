<?php
namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;

class ProductService
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * This class construct
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get all products in the system
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function getAllProducts():\Illuminate\Http\Resources\Json\JsonResource
    {
        return ProductResource::collection($this->productRepository->getAllProducts())->response()->getData(true);
    }

    /**
     * Create a new product record
     *
     * @param array $valid
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function createProduct(array $valid): \Illuminate\Http\Resources\Json\JsonResource
    {
        return new ProductResource($this->productRepository->createProduct($valid));
    }


}
