<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * This controller construct
     *
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('All Products',$this->productService->getAllProducts());
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('Product Created', $this->productService->createProduct($request->validated()));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(string $uuid): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('Product Fetched', $this->productService->getProduct($uuid));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param string $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, string $uuid): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('Product Fetched', $this->productService->updateProduct($request->validated(),$uuid));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $uuid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $uuid): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->success('Product Deleted', $this->productService->deleteProduct($uuid));
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
