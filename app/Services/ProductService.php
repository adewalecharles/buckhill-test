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
     * @return array
     *
     * @throws \Exception
     */
    public function getAllProducts(): array
    {
        $products = $this->productRepository->getAllProducts();
        if ($products) {
            return ProductResource::collection($products)->response()->getData(true);
        }
        throw new \Exception('Could not get products');
    }

    /**
     * Create a new product record
     *
     * @param array $valid
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     *
     * @throws \Exception
     */
    public function createProduct(array $valid): \Illuminate\Http\Resources\Json\JsonResource
    {
        $product = $this->productRepository->createProduct($valid);

        if ($product) {
            return new ProductResource($product);
        }

        throw new \Exception('Could not create product');
    }

    /**
     * Get a single product using uuid
     *
     * @param string $uuid
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     *
     * @throws \Exception
     */
    public function getProduct(string $uuid): \Illuminate\Http\Resources\Json\JsonResource
    {
        $product = $this->productRepository->getProduct($uuid);

        if ($product) {
            return new ProductResource($product);
        }

        throw new \Exception('Product not found');
    }

    /**
     * Update a Product record
     *
     * @param array $valid
     *
     * @param string $uuid
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function updateProduct(array $valid, string $uuid): \Illuminate\Http\Resources\Json\JsonResource
    {
        $product = $this->productRepository->updateProduct($valid, $uuid);

        if ($product) {
            return new ProductResource($product);
        }

        throw new \Exception('Product not found');
    }

    /**
     * Delete a Product record
     *
     * @param string $uuid
     *
     * @return bool
     */
    public function deleteProduct(string $uuid): bool
    {
        $product =  $this->productRepository->deleteProduct($uuid);

        if ($product) {
            $product->delete();
            return true;
        }

        throw new \Exception('Could not delete product');
    }


}